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
            "phone"=>"required",
            "user_id"=>"required",
        ]);
        $utilisateur = Utilisateur::create([
            "nom"=>$request->nom,
            "prenom"=>$request->prenom,
            "photo"=>$request->photo,
            "phone"=>$request->phone,
            "user_id"=>$request->user_id,
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
            "phone"=>"required",
            "user_id"=>"required",
        ]);
        $utilisateur = Utilisateur::where('id',$request->id)->update([
            "nom"=>$request->nom,
            "prenom"=>$request->prenom,
            "photo"=>$request->photo,
            "phone"=>$request->phone,
            "user_id"=>$request->user_id,
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
    public function uploadImgU(Request $request){

        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        if ($request->hasFile('photo')) {

            // Génération d'un nom unique pour l'image
            $picName = time() . '.' . $request->file('photo')->extension();
    
            // Déplacement du fichier vers le répertoire public/images
            $request->file('photo')->move(public_path('images'), $picName);
    
            // Retourner l'URL de l'image téléchargée
            return response()->json(['image_url' => "/images/$picName"]);
    
        } else {
            // Aucun fichier image n'a été téléchargé, retourner une erreur
            return response()->json(['error' => "Aucune image n'a été téléchargée."], 400);
        }

    }
    public function deleteImageU(Request $request, $hasFullPath = false){
        $request->validate([
            'photo'=>'required'
        ]);

        if (!$hasFullPath) {
            $filePath = public_path() .$request->photo;
        }

        if(file_exists($filePath)){
            @unlink($filePath);
        }

        return 'done';
    }
}
