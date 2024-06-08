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
            "role"=>"required",
            
        ]);
        $user = User::create([
            "username"=>$request->username,
            "email"=>$request->email,
            "password"=>bcrypt($request->password),
            "role"=>$request->role,
        ]);
        return response()->json([
            "user"=>$user
        ]);
    }
    public function Login(Request $request){
        $login = $request->validate([
            "email"=> ["required","email"],
            "password"=> ["required","string","min:3","max:30"]
        ]);

        $user = User::where("email",$login["email"])->first();

        if (Auth::attempt($login)) {
            $token = $user->createToken("CLE_SECRETE")->plainTextToken;
            return response()->json([
                "User" => $user,
                "Token" => $token      
            ],200);
        }else{
            return response()->json([
                "message"=> "Adresse email ou mot de passe incorrect"
            ],401);
        }

        
    }
    public function authUserVerify(){
        // Vérifier si un utilisateur est connecté
        if (Auth::check()) {
        // L'utilisateur est connecté
        // Vous pouvez accéder à l'utilisateur authentifié via auth()->user()
        //$user = auth()->user();
        return response()->json([
            'connect' => true
        ]);
        // Faites ici ce que vous avez besoin de faire pour un utilisateur connecté
        } else {
        // L'utilisateur n'est pas connecté
        // Faites ici ce que vous avez besoin de faire pour un utilisateur non connecté
        return response()->json([
            'connect' => false
        ]);
        }
    }
    public function CurrentUser(){
        $user = Auth::user();
        
        if ($user) {
            return response()->json([
                'user' => $user,
                'role' => $user->role
            ]);
        }
    }
    public function Logout(Request $request){
        $user = Auth::user();
        
        if ($user) {
            Auth::logout();
            $user->tokens->each(function($token){
                $token->delete();
            });
        }

        return response()->json([
            "message"=>"Deconnexion"
        ],200);
    }
    public function AllUser(){
        $user = User::where('role','Client')->orderBy('id','desc')->paginate(6);
        $userP = User::where('role','Partenaire')->orderBy('id','desc')->paginate(6);
        $alluser = User::where('role','!=','Client')->where('role','!=','Partenaire')->orderBy('id','desc')->paginate(6);
        return response()->json([
            "users"=>$user,
            "userPa"=>$userP,
            "alluser"=>$alluser
        ]);
    }
    public function GetUser($id){
        $user = User::where('id',$id)->first();
        return response()->json([
            "user"=>$user
        ]);
    }
    public function DelUser(Request $request){
        $user = User::where('id',$request->id)->first();
        return response()->json([
            "user"=>$user
        ]);
    }
}
