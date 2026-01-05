<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function login(){
        return view('seller.login');
    }


    public function loginstore(Request $request){

        $credential = $request->only('email','password');
        
        if(\Auth::guard('seller')->attempt($credential)){
            return back()->with(['success'=>'login successfull']);
        }else{
            return back()->with(['fail'=>'credential failed']);
        }
    }

     public function dashboard(){
      return view('dashboard');
    }
}
