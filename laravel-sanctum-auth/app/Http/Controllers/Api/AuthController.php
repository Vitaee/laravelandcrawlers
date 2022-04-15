<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends BaseController
{
    /**
     * handle with login request.
     */
    public function signin(UserLoginRequest $request)
    {
        $inputArr = $request->all();

        $userObj = User::where('email', $inputArr['email'])->first();

        if(!$userObj){
            return $this->sendError('Email not found.');
        }

        if (!Auth::attempt(['email' => $inputArr['email'], 'password' => $inputArr['password']])) {
            return $this->sendError('Invalid credentials');
        }

        if ( ! Hash::check($inputArr['password'], $userObj->password, [])) {
            return $this->sendError('Invalid credentials');
        }

        $authToken = $userObj->createToken('MyAuthApp')->plainTextToken;
        $name = $userObj->name;

        $returnArr = [
            'token' => $authToken,
            'name' => $name
        ];

        return $this->sendResponse($returnArr, 'User signed in.');
        
        /*if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $authUser = Auth::user(); // Auth::user()->instanceof
            if ($authUser instanceof \App\Models\User) {
                $succes['token'] = $authUser->createToken('MyAuthApp')->plainTextToken;
                $succes['name'] = $authUser->name;
                return $this->sendResponse($succes, 'User signed in');
           }else {
               return $this->sendError('User error', ['error' => 'User is not instance of user model']);
           }
          
        }

        return $this->sendError('Unauthorized', ['error' => 'Unauthorised']);*/
    }

    /**
     * handle with register request.
     */
    public function signup(UserRegisterRequest $request)
    {
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] =  $user->name;
   
        return $this->sendResponse($success, 'User created successfully.');

    }

}