<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:150',
            'email' => 'nullable|string|max:100',
            'logo' => 'image|mimes:jpeg,bmp,png|max:2000',
            'website' => 'nullable|string|max:255',
        ];
    }


    public function attributes()
    {
        return [
            'first_name' => 'name'
        ];
    }

}
