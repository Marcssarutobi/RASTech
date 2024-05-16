<?php

namespace App\Http\Controllers;

use App\Models\Utilisateur;
use Illuminate\Http\Request;

class UtilisateurController extends Controller
{
    public function CreateUtlisateur(Request $request){
        $this->validate($request,[
            "nom"=>"required",
            "prenom"=>"required",
            "photo"=>"required",
            "tel"=>"required",
            "email"=>"required",
            "password"=>"required",
            "role"=>"required",
        ]);
        $utilisateur = Utilisateur::create([
            "nom"=>$request->nom,
            "prenom"=>$request->prenom,
            "photo"=>$request->photo,
            "tel"=>$request->tel,
            "email"=>$request->email,
            "password"=>$request->password,
            "role"=>$request->role,
        ]);
        return response()->json([
            "User"=>$utilisateur
        ]);
    }
    public function GetUtilisateur($id){
        $utilisateur = Utilisateur::where('id',$id)->first();
        return response()->json([
            "user"=>$utilisateur
        ]);
    }
    public function AllUtilisateur(){
        $utilisateurs = Utilisateur::orderBy('id','desc')->paginate(6);
        return response()->json([
            "alluser"=>$utilisateurs
        ]);

    }
    public function UpdateUtlisateur(Request $request){
        $request->validate([
            "nom"=>"required",
            "prenom"=>"required",
            "photo"=>"required",
            "tel"=>"required",
            "email"=>"required",
            "password"=>"required",
            "role"=>"required",
        ]);
        $utilisateur = Utilisateur::where('id',$request->id)->update([
            "nom"=>$request->nom,
            "prenom"=>$request->prenom,
            "photo"=>$request->photo,
            "tel"=>$request->tel,
            "email"=>$request->email,
            "password"=>$request->password,
            "role"=>$request->role,
        ]);
        return response()->json([
            "updateUser"=>$utilisateur
        ]);
    }
    public function DeleteUtilisateur(Request $request){
        $utilisateur = Utilisateur::where('id',$request->id)->delete();
        return response()->json([
            "delUser"=>$utilisateur
        ]);
    }
}
