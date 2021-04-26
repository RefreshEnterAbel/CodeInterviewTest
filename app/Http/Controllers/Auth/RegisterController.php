<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponser;

class RegisterController extends Controller
{
    // use ApiResponser;

    // register method
    public function register(Request $request)
    {
       
        // check request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);
    
        // user create on database
        $user = User::create([
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
            'email' => $request->input('email')
        ]);

        return $request->all();
        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
    }
}
