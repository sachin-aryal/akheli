<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function _construct(){
        $this->middleware('auth');
    }

    public function index(){
        $users= user::all();
        return view('user/list',compact('users'));
    }

    public function userStatus(Request $request){
        $user_id = $request->user_id;
        $user = User::find($user_id);
        if($user->enabled){
            $user->enabled = false;
        }else{
            $user->enabled = true;
        }
        $user->update();
        return $this->index();
    }
}
