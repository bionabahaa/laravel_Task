<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use DB;


class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('created_at', 'DESC')->paginate(10);

	    	return view('companies.index', compact('companies'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {

          $company = Company::create($request->all());

			if ($request->has('logo')) {
				$logo = $request->file('logo')->storeAs('logo', $company->id, 'public');
				$company->update(['logo' => $company->id]);
			}

            return redirect()->route('companies.index')->with('success', 'company  successfully Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
	{
		return view('companies.show', compact('company'));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
	{
		return view('companies.edit', compact('company'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        if ($request->has('logo')) {
			$logo = $request->file('logo')->storeAs('logo', $company->id, 'public');
		}

		$company->update([
			'first_name' => $request->first_name,
			'email' => $request->email,
			'website' => $request->website,
			'logo' => $company->id
		]);


		return redirect()->route('companies.index')->with('company', 'company successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect()->route('companies.index')->with('company', 'company successfully deleted');
    }
}
