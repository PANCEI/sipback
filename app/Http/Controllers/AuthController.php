<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
       //echo Hash::make($request->password);
         $user = User::where('email', $request->email)->first();
        var_dump($user);
        
    }
}
