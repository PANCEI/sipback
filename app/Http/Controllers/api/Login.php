<?php
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AksesUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Login extends Controller{

    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
    $user = User::where('email', $request->email)->first();
    if(!$user || !Hash::check($request->password, $user->password)){
        return response()->json([
            "Gagal Melakukan Login"
        ], 401);
    }

    // ini untuk ambil akses usernya 
    $akses= AksesUser::where('id',$user['id'])->value('id_akses');
    
    // buat token untuk tanda pengenal nanti ketika melakukan request setelah login
           $token = $user->createToken('auth_token')->plainTextToken;
    //var_dump($user);
     return response()->json([
            'message' => 'Login berhasil',
            'user'    => $user,
            'token'   => $token,
            "akses"=>$akses
        ]);
    }
    
}