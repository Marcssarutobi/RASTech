<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function CreateCMD(Request $request){

        $this->validate($request,[
            "user_id"=>"required",
            "prod_id"=>"required",
            "qte"=>"required",
            "prix"=>"required"
        ]);
        $cmd = Commande::create([
            "user_id"=>$request->user_id,
            "prod_id"=>$request->prod_id,
            "qte"=>$request->qte,
            "prix"=>$request->prix,
        ]);
        return response()->json([
            "cmds" => $cmd
        ]);

    }
    public function AllCMD(){
        $cmd = Commande::orderBy('id','desc')->get();

        return response()->json([
            "cmds"=>$cmd
        ]);
    }
}
