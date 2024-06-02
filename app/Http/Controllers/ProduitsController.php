<?php

namespace App\Http\Controllers;

use App\Models\Produits;
use Illuminate\Http\Request;

class ProduitsController extends Controller
{
    public function uploadImg(Request $request){ # Uploder une image dans un dossier

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif'
        ]);

        if ($request->hasFile('image')) {

            // Génération d'un nom unique pour l'image
            $picName = time() . '.' . $request->file('image')->extension();
    
            // Déplacement du fichier vers le répertoire public/images
            $request->file('image')->move(public_path('images'), $picName);
    
            // Retourner l'URL de l'image téléchargée
            return response()->json(['image_url' => "/images/$picName"]);
    
        } else {
            // Aucun fichier image n'a été téléchargé, retourner une erreur
            return response()->json(['error' => "Aucune image n'a été téléchargée."], 400);
        }

    }
    public function CreatePro(Request $request){
        $this->validate($request,[
            "image"=>"required",
            "name_prod"=>"required",
            "categorie_id"=>"required",
            "qte"=>"required",
            "PVente"=>"required",
            "description"=>"required",
            "type"=>"",
            "dispo"=>"",
        ]);
        $prod = Produits::create([
            "image"=>$request->image,
            "name_prod"=>$request->name_prod,
            "categorie_id"=>$request->categorie_id,
            "qte"=>$request->qte,
            "PVente"=>$request->PVente,
            "description"=>$request->description,
            "type"=>$request->type,
            "dispo"=>$request->dispo,
        ]);
        return response()->json([
            "prod"=>$prod
        ]);

    }
    public function AllProd(){
        $prod = Produits::where('type',null)->where('dispo',null)->orderBy('id','desc')->paginate(8);
        $prodP = Produits::where('type','!=',null)->where('dispo','!=',null)->orderBy('id','desc')->paginate(6);
        $prods = Produits::orderBy('id','desc')->get();
        return response()->json([
            "produits"=>$prod,
            "prods"=>$prods,
            "prodP"=>$prodP
        ]);
    }
    public function show($id){
        $prod = Produits::where('id',$id)->first();
        return response()->json([
            "prod"=> $prod
        ]);
    }
    public function deleteImage(Request $request, $hasFullPath = false){

        $request->validate([
            'image'=>'required'
        ]);

        if (!$hasFullPath) {
            $filePath = public_path() .$request->image;
        }

        if(file_exists($filePath)){
            @unlink($filePath);
        }

        return 'done';

    }
    public function updateProduits(Request $request){

        $request->validate([
            "image"=>"required",
            "name_prod"=>"required",
            "categorie_id"=>"required",
            "qte"=>"required",
            "PVente"=>"required",
            "description"=>"required",
        ]);

        $produit = Produits::where('id',$request->id)->update([
            "image"=>$request->image,
            "name_prod"=>$request->name_prod,
            "categorie_id"=>$request->categorie_id,
            "qte"=>$request->qte,
            "PVente"=>$request->PVente,
            "description"=>$request->description,
        ]);

        return response()->json([
            "produit"=>$produit
        ]);

    }
    public function delProd(Request $request, $hasFullPath = false){
        //Premièrement effacer le fichier originel du server
        if(!$hasFullPath){
            $filePath = public_path() . $request->image;
        }

        if(file_exists($filePath)){
            @unlink($filePath);
        }

        $produit = Produits::where('id',$request->id)->delete();

        return response()->json([
            "produit"=> $produit
        ]);
    }
}
