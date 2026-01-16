<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Notifications\UserRegisteredNotification;

class AdminController extends Controller
{
     public function create(){

        return view('admin.create');
     }
     

      public function store(Request $request){
       // dd(auth()->check());

          $valide = $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6'
          ]);
          $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>\Hash::make($request->password)
          ];

          $user = User::create($data);
          
         $admin = User::where('role', 'admin')->first();
$admin->notify(new UserRegisteredNotification($user));
        //  $user->assignRole('admin');
          if($user){
            return back()->with(['success'=>'create successfully']);
          }else{
             return back()->with(['fail'=>'create failed']);
          }

      }


    public function login(){
        return view('admin.login');
    }

  public function loginstore(Request $request){

     $credential =   $request->only('email','password');

     if(\Auth::guard('admin')->attempt($credential)){

        return back()->with(['success'=>'login successfully']);

     }else{
        return back()->with(['fail'=>'invalide credential']);
     }
    }

    public function dashboard(){

     $user = User::get();
     //$user->hasRole('user');

      return view('dashboard',with(['user'=>$user]));
    }




    public function join($room)
    {
        return view('conference', compact('room'));
    }

public function signal(Request $request){

        broadcast(new WebRTCSignal($request->room, $request->type, $request->data))->toOthers();
        
        return response()->json(['status'=>'ok']);
    }

}
