<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Services\ShipyaaeiServices;
use App\Models\Employee;
use Laravel\Passport\PersonalAccessTokenResult;

class PracticeController extends Controller
{
     
  public function ship(ShipyaaeiServices $ship){
     
    $x = $ship->createshipyaari('rani');
    dd($x);
  }
// public function ship(){
//      $ship = new ShipyaaeiServices('radha','ji');
//     $x = $ship->createshipyaari('rani');
//     dd($x);
//   }





    public function store(Request $request){

        // dd($request->image);
       // $filename ="";
        $x = [];
      $file = $request->file('image');
    //  dd($file);
      foreach($file as $f){
               $filename = $f->getClientOriginalName();

                 $f->move(public_path('uploads'), $filename);
           
                 $x[] = $filename;

      }

     dd(json_encode($x));
     // dd($file);
       
    

        //dd($filename);
       // $file->StoreAs('/uploads',$filename,'public');
      // dd($file);
    // $path = $request->file('image')->store('uploads','public'); // ye storage wale me jayega 
     dd($path);
// $path = $request->file('image')->storeAs('uploads',$filename,'public'); // ye storage wale me jayega 
   
    
       // ye public me jayega 


        $post = Post::create([
            'user_id'=>4,
             'title'=>$request->title,
             'body'=>$request->body,
             'image'=> $path
        ]);

     


     

    }



     public function get(){
          
        $post = Post::find(4);
        return view('get_user',with(['post'=>$post]));
      }
   

      public function employee(Request $request){
        
        // $credential = $request->only('email','password');

        // if(\Auth::guard('employee')->attempt($credential)){
        //     dd(auth('employee')->id());
        //   return response()->json('successfully login');
        
        // }else{
        //   return response()->json('not successfully');
        // }
      }

      public function register(Request $request){
          //  dd('ddd');
           $employee = Employee::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>\Hash::make($request->password),
           ]);
                   $tokenResult = $employee->createToken('Personal Access Token'); // scopes optional: ['view-orders']
        $token = $tokenResult->accessToken;
        dd($token);
      }
}
