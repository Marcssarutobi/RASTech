<?php

namespace App\Http\Controllers;

use App\Models\CodePromo;
use Illuminate\Http\Request;

class CodePromoController extends Controller
{
    public function index(){
        $CodePromo = CodePromo::orderBy('id','desc')->get();
        $select = CodePromo::orderBy('id','desc')->get();
        return response()->json([
            "CodePromo"=>$CodePromo,
            "select"=>$select
        ]);
    }

    public function createCodePromo(Request $request){
        $this->validate($request,[
            'code'=>'required',
            'pourcentage'=>'required',
            'expire'=>'required',
            'used'=>'required',
        ]);

        $CodePromo = CodePromo::create([
            'code'=>$request->code,
            'pourcentage'=>$request->pourcentage,
            'expire'=>$request->expire,
            'used'=>$request->used,
        ]);

        return response()->json([
            "CodePromo"=>$CodePromo
        ]);
    }

    public function showCodePromo($id){
        $CodePromo = CodePromo::find($id);
        return response()->json([
            "CodePromo"=>$CodePromo
        ]);
    }

    public function updateCodePromo(Request $request, $id){
        $data = CodePromo::find($id);
        $CodePromo = $data->update($request->all());
        return response()->json([
            "CodePromo"=>$CodePromo
        ]);
    }

    public function deleteCodePromo($id){
        $data = CodePromo::find($id);
        $CodePromo = $data->delete();
        return response()->json([
            "CodePromo"=>$CodePromo
        ]);
    }

    public function getCodepromo($code){
        $CodePromo = CodePromo::where('code',$code)->first();

        if (!$CodePromo || $CodePromo->used === 1) {
            return response()->json([
                "message"=>"Ce code Promo n'est pas valide ou a déjà été utilisé"
            ],401);
        }

        return response()->json([
            "CodePromo"=>$CodePromo
        ]);
    }
}
