<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function CreateCat(Request $request){
        $this->validate($request,[
            "name_cat"=>"required"
        ]);
        
        $cat = Categories::create([
            "name_cat"=>$request->name_cat
        ]);
        return response()->json([
            "cat"=>$cat
        ]);
    }
    public function UpdateCat(Request $request){
        $this->validate($request,[
            "name_cat"=>"required"
        ]);
        $cat = Categories::where('id',$request->id)->update([
            "name_cat"=>$request->name_cat
        ]);
        return response()->json([
            "cat"=>$cat
        ]);
    }
    public function AllCat(){
        $cat = Categories::orderBy('id','desc')->paginate(6);
        return response()->json([
            "categories"=>$cat
        ]);
    }
    public function DelCate(Request $request){
        $cat = Categories::where('id',$request->id)->delete();
        return response()->json([
            "cat"=>$cat
        ]);
    }
    public function GetCat($id){
        $cat = Categories::where('id',$id)->first();
        return response()->json([
            "cat" => $cat
        ]);
    }
    public function Categories(){
        $cat = Categories::orderBy('id','desc')->get();
        return response()->json([
            "categories"=>$cat
        ]);
    }

}
