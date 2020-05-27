<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function getUser($id){
        $user = DB::table('users')->where('id', $id)->first();

        return response()->json($user);
    }

    public function addUser(Request $request){
        $passwd = Hash::make($request->password);

        DB::table('users')->insert([
            "fname" => $request->fname,
            "lname" => $request->lname,
            "email" => $request->email,
            "password" => $passwd,
            "role_id" => $request->role
        ]);
    }

    public function updateUser(Request $request){
        $origUser = DB::table('users')->where('id', $request->id)->first();
        $passwd = $origUser->password;

        if($passwd != $request->password){
            $passwd = Hash::make($request->password);
        }

        DB::table('users')
            ->where('id', $request->id)
            ->update([
                "fname" => $request->fname,
                "lname" => $request->lname,
                "email" => $request->email,
                "password" => $passwd,
                "role_id" => $request->role
            ]);
    }

    public function removeUser(Request $request){
        DB::table('users')->where('id', $request->id)->remove();
    }

    public function formHandler(Request $request){
        if($request->action == "add"){
            $this->addUser($request);
        }
        else if($request->action == "update"){
            $this->updateUser($request);
        }
        else if($request->action == "remove"){
            $tihs->removeUser($request);
        }
        return redirect('/users');
    }

    public function returnView(){
        $authUsers = DB::table('users')->orderBy('created_at', 'desc')->where('role_id', '<', 3)->get();
        $nonAuthUsers = DB::table('users')->orderBy('created_at', 'desc')->where('role_id', 3)->get();
        $roles = DB::table('roles')->orderBy('id')->get();

        return view('admin.users')->with(compact('authUsers'))->with(compact('nonAuthUsers'))->with(compact('roles'));
    }
}
