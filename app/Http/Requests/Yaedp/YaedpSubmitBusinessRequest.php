<?php

namespace App\Http\Requests\Yaedp;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class YaedpSubmitBusinessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'name' => 'required',
            'user_id' => 'required',
            'date_of_establishment' => 'required',
            'years_of_operation' => 'required|integer',
            'physical_address' => 'required',
            'online_address' => 'required',
            'staff_size' => 'required|integer',
            'business_description' => 'required',
            'images' => 'required|mimes:jpg,jpeg,png|max:5048',
        ];
    }

    public function messages()
    {
        return [
            'years_of_operation.integer' => 'A number is required for years of operation',
        ];
    }

    protected function failedValidation(Validator $validator){

        // return errors in json object/array
        $message = $validator->errors()->all();
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $message
        ]));
    }
}
