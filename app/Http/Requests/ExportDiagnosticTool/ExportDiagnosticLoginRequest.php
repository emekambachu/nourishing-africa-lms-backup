<?php

namespace App\Http\Requests\ExportDiagnosticTool;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ExportDiagnosticLoginRequest extends FormRequest
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
            'email' => 'required|email|exists:yedp_users,email',
            'password' => 'required|min:6',
        ];
    }

    public function messages(){
        return [
            'email.required' => 'Email is required!',
            'email.exists' => 'Email does not exist!',
            'password.required' => 'Password is required!',
        ];
    }

    protected function failedValidation(Validator $validator){
        if($this->wantsJson()){
            $response = response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

//        if($this->wantsJson()) {
//            $response = response()->json([
//                'success' => false,
//                'message' => 'Ops! Some errors occurred',
//                'errors' => $validator->errors()
//            ]);
//        }else{
//            $response = redirect()
//                ->route('yaedp.forgot-password')
//                ->with('message', 'Ops! Some errors occurred')
//                ->withErrors($validator);
//        }

        throw (new ValidationException($validator, $response))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
