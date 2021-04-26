<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // use api josn trim
    use ApiResponser; 

    // Login methiod 
    public function login(Request $request)
    {
        // check request data
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);
        // if user attempt on database 
        if (!Auth::attempt($attr)) {
            return $this->error('Credentials not match Please input corect pasword and email', 401);
        }

        return $this->success([
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ]);
    }

     // Logout methiod 
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
