<?php

namespace App\Http\Controllers;

use App\Models\Userinfo;
use Illuminate\Http\Request;

class UserinfoController extends Controller
{
    public function CreateInfoUser(Request $request){
        $this->validate($request,[
            "profil"=>"required",
            "nom"=>"required",
            "prenom"=>"required",
            "phone"=>"required",
            "ville"=>"required",
            "quartier"=>"required",
            "user_id"=>"required",
        ]);
        $userinfo = Userinfo::create([
            "profil"=>$request->profil,
            "nom"=>$request->nom,
            "prenom"=>$request->prenom,
            "phone"=>$request->phone,
            "ville"=>$request->ville,
            "quartier"=>$request->quartier,
            "user_id"=>$request->user_id,
        ]);
        return response()->json([
            "userinfo"=>$userinfo
        ]);
    }
    public function uploadImgC(Request $request){
        $request->validate([
            'profil' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        if ($request->hasFile('profil')) {

            // Génération d'un nom unique pour l'image
            $picName = time() . '.' . $request->file('profil')->extension();
    
            // Déplacement du fichier vers le répertoire public/images
            $request->file('profil')->move(public_path('images'), $picName);
    
            // Retourner l'URL de l'image téléchargée
            return response()->json(['image_url' => "/images/$picName"]);
    
        } else {
            // Aucun fichier image n'a été téléchargé, retourner une erreur
            return response()->json(['error' => "Aucune image n'a été téléchargée."], 400);
        }
    }
    public function deleteImageC(Request $request, $hasFullPath = false){
        $request->validate([
            'profil'=>'required'
        ]);

        if (!$hasFullPath) {
            $filePath = public_path() .$request->profil;
        }

        if(file_exists($filePath)){
            @unlink($filePath);
        }

        return 'done';
    }
    public function GetUserInfo($id){
        $user = Userinfo::where('user_id',$id)->first();
        return response()->json([
            "info"=>$user
        ]);
    }
    public function DelUserInfo(Request $request,$hasFullPath = false){
        //Premièrement effacer le fichier originel du server
        if(!$hasFullPath){
            $filePath = public_path() . $request->image;
        }

        if(file_exists($filePath)){
            @unlink($filePath);
        }

        $user = Userinfo::where('id',$request->id)->delete();

        return response()->json([
            "deluserinfo"=>$user
        ]);
    }
    
}
