<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\helpers;
use App\Mytrait;
use Laravel\Passport\PersonalAccessTokenResult;

class AuthController extends Controller
{
    use Mytrait;

    public function register(Request $r)
    {
      

       try{
        
           $file = $r->image;
           //helper

        $path =   helpers::uploadImage($file , 'imageManager');
        

       // dd($path );
         // trait

    //  $path = $this->uploadImage($file,'imageManager');
         
         //  $filename = time().'/'.$file->getClientOriginalName();
        //     $file->move(public_path('uploads'),$filename);
         //   \Storage::disk('public')->put('uploads/'.$filename, file_get_contents($file));
         ///  dd($path);

        $user = User::create([
            'name' => $r->name,
            'email'=> $r->email,
            'password' => $r->password,
            'image'=> $path ?? null
            
        ]);

        // if(!$user){
        //     throw new Exception('incorrect ......');
        // }

       // dd($user);
        // Option A: Personal Access Token
        $tokenResult = $user->createToken('Personal Access Token'); // scopes optional: ['view-orders']
        $token = $tokenResult->accessToken;

        // throw new Exception("incorrect...");

        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);

     

    }catch(\Throwable $e){

        \Log::error($e->getMessage());

        return response()->json(['message'=> 'incorrect'],500);
    }
    }

    public function login(Request $r)
    {
       // dd('hello');
       //dd($r->email);
       try{
        
        // dd($user);
        $user = User::where('email', $r->email)->first();
       // dd($user);
       // dd(Hash::check($r->password, $user->password));
        if (! $user || ! Hash::check($r->password, $user->password)) {
            return response()->json(['message'=>'Invalid credentials'], 401);
        }
       // dd('hello');
        // Option A: Personal Access Token (simplest)
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->accessToken;
       //   dd($tokenResult);
        return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }catch(\Throwable $e){
        \Log::error($e->getmessage());
        return response()->json('wrong');
    }
    }

    public function employee_login(Request $request){
           
      dd('hello');
             
             $credential = $request->only('email','password');
             if(\Auth::guard('api_employee')->attempt($credential)){
            
                $token = $credential->createToken('Personal Access Token');

                dd($token);
                return response()->json([
                          'token'=>$token,
                          'status'=>200
                ]);
             }else{
                return response()->json('Invalide credentials');
             }
    }

    public function logout(Request $r)
    {
        $user = $r->user();
        // Revoke current token
        $r->user()->token()->revoke();
        return response()->json(['message'=>'Logged out']);
    }

    public function me(Request $r)
    {
         $user =  User::all();
         //Auth('api')->id(); 
        // dd($r->user());
        return response()->json($user);
    }

    public function  delete(Request $r,$id)
    {
         $user = User::find($id)->delete();

        return response()->json(['message'=>'delete successfully']);
    }

    public function edit($id){
        $user = User::find($id);
        return response()->json($user);
    }

    public function update(Request $request ,$id){
        
               if($request->hasFile('image')){
               
                $oldImage = $request->oldImage;
                $file = $request->image;

                // dd($oldImage,$file);
                $path =  $this->uploadImage($file,'imageManager', $oldImage);
    }else{
        $path = $request->oldImage;
    }

        $data = [
            'name'=>$request->name,
            'email'=> $request->email,
            'image'=>$path ?? null
        ];

        User::find($id)->update($data);
return response()->json(['message'=> 'update successfully']);

    }
}
