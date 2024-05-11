<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function signup(Request $request){
        $this->validate($request,[
            "username"=>"required",
            "email"=>["required","email","unique:users,email"],
            "password"=>["required","string","min:8","max:30"],
            
        ]);
        $user = User::create([
            "username"=>$request->username,
            "email"=>$request->email,
            "password"=>bcrypt($request->password),
        ]);
        return response()->json([
            "user"=>$user
        ]);
    }
    public function Login(Request $request){
        $login = $request->only('email','password');
        if (Auth::attempt($login)) {
            return response()->json([
                "login"=>$login
            ]);
        }else{
            return response()->json(['message' => 'Échec de la connexion'], 401);
        }
    }
    public function CurrentUser(){
        $user = Auth::user();
        return response()->json([
            "User"=>$user
        ]);
    }
    public function Logout(Request $request){
        Auth::logout();
        return response()->json(['message' => 'Déconnexion réussie']);
    }
}
