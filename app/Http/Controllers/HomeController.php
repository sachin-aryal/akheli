<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['client', 'admin']);
        if($request->user()->authorizeRoles(['client', 'admin'])){
            return view('home');
        }
        echo "Not Accessible";
        return;
    }

    function test_admin(Request $request){
        if ($request->user()->authorizeRoles(['admin'])){
            echo "Route Accessed successfully.";
            return;
        }
        return view('home');
    }
}
