<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,NULL,id',
            'password' => 'required|min:5',
            'confirm_password' => 'required|same:password',
            //'image' => 'max:1024',
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
            'name.required' => 'Please enter name',

            'email.required'  => 'Please enter your email',
            'email.unique'  => 'This email already exist',
            'email.email'  => 'Please enter a valid email',

            'password.required' => 'Please enter the PIN',
            'password.max' => 'Please enter maximum 255 characters',

            'confirm_password.same' => "Password and confirm Password doesn't match",
            'confirm_password.required' => 'Please enter confirm Password',
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