<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function CreateRole(Request $request){
        $this->validate($request,[
            "name_role"=>"required"
        ]);
        $role = Role::create([
            "name_role"=>$request->name_role
        ]);
        return response()->json([
            "newrole"=>$role
        ]);
    }
    public function AllRole(){
        $roles6 = Role::orderBy('id','desc')->paginate(6);
        $roles = Role::orderBy('id','desc')->get();
        return response()->json([
            "roles"=>$roles6,
            "rolesT"=> $roles
        ]);
    }
    public function GetRole($id){
        $role = Role::where('id',$id)->first();
        return response()->json([
            "role"=>$role
        ]);
    }
    public function UpdateRole(Request $request){
        $request->validate([
            "name_role"=>"required"
        ]);
        $role = Role::where('id',$request->id)->update([
            "name_role"=>$request->name_role
        ]);
        return response()->json([
            "role"=>$role
        ]);
    }
    public function DeleteRole(Request $request){
        $role = Role::where('id',$request->id)->delete();
        return response()->json([
            "role"=>$role
        ]);
    }
}
