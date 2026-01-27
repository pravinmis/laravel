<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
                     $user = User::where('id',auth()->id())->get();
                    //  dd($user);
      return view('dashboard',compact('user'));
    }
}
