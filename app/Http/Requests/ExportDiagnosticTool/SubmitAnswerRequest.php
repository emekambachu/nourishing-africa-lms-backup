<?php

namespace App\Http\Requests\ExportDiagnosticTool;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class SubmitAnswerRequest extends FormRequest
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
    public function rules(){
        return [
            'option_id' => 'required|sometimes',
            'option_ids' => 'required|sometimes',
            'answer' => 'required|sometimes',
        ];
    }

    public function messages(){
        return [
            'option_id.required' => 'Select an option to proceed!',
            'option_ids.required' => 'Select one or more options to proceed!',
            'answer.required' => 'An answer is required to proceed!',
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
