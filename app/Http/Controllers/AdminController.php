<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;

class AdminController extends Controller
{
     public function create(){

        User::create([
            'name'=>'uhu',
            'email'=>'u@gmail.com',
             'password'=>'pravin'

        ]);
     }
     
     public function index(){


      $user = User::find(1);
      
      if ($user->hasRole('admin')) {
    echo "Admin hai!";
}

if ($user->can('edit post')) {
    echo "User edit kar sakta hai!";
}

        return "hello";
     }
}
