<?php

namespace App\Http\Requests\Yaedp;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class YaedpSubmitProductRequest extends FormRequest
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
            'type' => 'required',
            'yaedp_value_chain_id' => 'required',
            'source_of_material' => 'required',
            'organically_produced' => 'required',
            'nutrition_information_provided' => 'required',
            'how_to_prepare' => 'required',
            'weight_per_pack' => 'required',
            'form' => 'required',
            'capacity' => 'required',
            'packaging_method' => 'required',
            'quantity_available' => 'required',
            'images' => 'required|mimes:jpg,jpeg,png|max:5048',
        ];
    }

    public function messages()
    {
        return [

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
