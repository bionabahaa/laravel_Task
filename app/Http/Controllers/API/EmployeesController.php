<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Company;
use App\Models\Employee;
use Validator;
use App\Http\Resources\Company as CompanyResources;
use App\Http\Resources\Employee as EmployeeResources;


class EmployeesController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();

        return $this->sendResponse(EmployeeResources::collection($employee), 'employee retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'first_name' =>  'required',
            'last_name'  =>   'required',
            'company_id' =>  'required'

        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $employee = Employee::create($input);

        return $this->sendResponse(new EmployeeResources($employee), 'employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);

        if (is_null($employee)) {
            return $this->sendError('employee not found.');
        }

        return $this->sendResponse(new EmployeeResources($employee), 'employee retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'first_name' => 'required',
            'last_name'  => 'required',
            'company_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $employee->first_name  = $input['first_name'];
        $employee->last_name   = $input['last_name'];
        $employee->company_id  = $input['company_id'];
        $employee->save();

        return $this->sendResponse(new EmployeeResources($employee), 'employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();

        return $this->sendResponse([], 'employee deleted successfully.');
    }
}
