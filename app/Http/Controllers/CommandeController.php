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
            "prix"=>"required",
            "livraison"=>"required"
        ]);
        $cmd = Commande::create([
            "user_id"=>$request->user_id,
            "prod_id"=>$request->prod_id,
            "qte"=>$request->qte,
            "prix"=>$request->prix,
            "livraison"=>$request->livraison,
        ]);
        return response()->json([
            "cmds" => $cmd
        ]);

    }
    public function AllCMD(){
        $cmd = Commande::orderBy('id','desc')->get();
        
        return response()->json([
            "cmds"=>$cmd,
        ]);
    }
    public function GetCMD($id){
        $cmd = Commande::where('id',$id)->first();
        return response()->json([
            "cmd"=>$cmd
        ]);
    }
    public function DelCMD(Request $request){
        $cmd = Commande::where('id',$request->id)->first();
        return response()->json([
            "cmd"=>$cmd
        ]);
    }
    public function UpdateCMD(Request $request){
        $this->validate($request,[
            "user_id"=>"required",
            "prod_id"=>"required",
            "qte"=>"required",
            "status"=>"required",
            "prix"=>"required",
            "livraison"=>"required"
        ]);
        $cmd = Commande::where('id',$request->id)->update([
            "user_id"=>$request->user_id,
            "prod_id"=>$request->prod_id,
            "qte"=>$request->qte,
            "status"=>$request->status,
            "prix"=>$request->prix,
            "livraison"=>$request->livraison,
        ]);
        return response()->json([
            "cmds" => $cmd
        ]);
    }
    public function CMDP($id){
        $cmds = Commande::where('user_id',$id)->orderBy('user_id','desc')->get();
        return response()->json([
            "cmd"=>$cmds
        ]);
    }
}
