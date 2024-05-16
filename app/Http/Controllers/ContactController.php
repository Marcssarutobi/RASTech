<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function CreateContact(Request $request){
        $this->validate($request,[
            "name"=>"required",
            "email"=>"required",
            "subject"=>"required",
            "message"=>"required",
            "status"=>"required",
        ]);
        $ctn = Contact::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "subject"=>$request->subject,
            "message"=>$request->message,
            "status"=>$request->status,
        ]);
        return response()->json([
            "NewCtn"=>$ctn
        ]);
    }

    public function AllContact(){
        $ctns = Contact::orderBy('id','desc')->paginate(6);
        return response()->json([
            "allCtns"=>$ctns
        ]);
    }

    public function  GetContact($id) {
        $ctn = Contact::where('id', $id)->first();
        return response()->json([
            "ctn"=>$ctn
        ]);
    }

    public function DelContact(Request $request){
        $ctn = Contact::where('id',$request->id)->delete();
        return response()->json([
            "delctn"=>$ctn
        ]);
    }
}
