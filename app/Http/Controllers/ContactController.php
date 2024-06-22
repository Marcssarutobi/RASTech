<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\DemandeEmail;
use Illuminate\Support\Facades\Mail;
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
            "allctns"=>$ctns
        ]);
    }

    public function  GetContact($id) {
        $ctn = Contact::where('id', $id)->first();
        return response()->json([
            "ctn"=>$ctn
        ]);
    }

    public function UpdateContact(Request $request){
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "subject"=>"required",
            "message"=>"required",
            "status"=>"required",
        ]);
        $ctn = Contact::where('id',$request->id)->update([
            "name"=>$request->name,
            "email"=>$request->email,
            "subject"=>$request->subject,
            "message"=>$request->message,
            "status"=>$request->status,
        ]);
        return response()->json([
            "update"=>$ctn
        ]);
    }

    public function DelContact(Request $request){
        $ctn = Contact::where('id',$request->id)->delete();
        return response()->json([
            "delctn"=>$ctn
        ]);
    }

    public function Email(Request $request){
        $user = $request->validate([
            "message"=>"required",
            "email"=>"required",
            "name"=>"required",
        ]);

        try {
            Mail::to($user['email'])->send(new DemandeEmail($user));
            return response()->json(['message' => 'Email sent successfully.'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to send email. Please try again.'], 500);
        }
    }
}
