<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function CreateNew(Request $request){
        $this->validate($request,[
            "email" => "required"
        ]);
        $news = Newsletter::create([
            "email"=>$request->email
        ]);
        return response()->json([
            "New" => $news
        ]);
    }

    public function AllNew(){
        $news = Newsletter::orderBy('id','desc')->paginate(6);
        return response()->json([
            "News"=>$news
        ]);
    }

    public function GetNew($id){
        $new = Newsletter::where('id',$id)->first();
        return response()->json([
            "new"=>$new
        ]);
    }

    public function DelNew(Request $request){
        $new = Newsletter::where('id',$request->id)->delete();
        return response()->json([
            "delNew"=>$new
        ]);
    }
}
