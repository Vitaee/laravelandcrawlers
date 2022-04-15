<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make the request.
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
            'email' => 'required',
            'password' => 'required'
          ];
      }

      /**
       * Get the error messages for the defined validation rules.
       * 
       * @return array
       */
      public function messages()
      {
          return [
              'password.required' => 'Please enter a password',
              'email.required' => 'Please enter email address'
          ];
      }

      public function failedValidation(Validator $validator)
      {
          $errorMessages = $validator->errors()->all();
          $returnArr = [
            'statusCode' => 422,
            'status' => 'vaidation error',
            'message' => $errorMessages[0],
        ];

        throw new HttpResponseException(response()->json($returnArr, 422));
      }

}