<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    // use api trim
    use ApiResponser;

    // Login method
    public function login(Request $request)
    {
        // check request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()){
            return  $validator->errors();
        }
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        // if user attempt on database
        if (!Auth::attempt($data)) {
            return $this->error('Credentials not match Please input correct password and email', 401);
        }

        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }

     // Logout method
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
