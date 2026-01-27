<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;

class UserProfileController extends Controller
{
public function index(){

         $user = UserProfile::get();

       return view('users.index',compact('user'));
    }

public function show(){

         $user = UserProfile::get();

       return view('users.index',compact('user'));
    }

public function create(){
 return view('users.create');
}

public function store(Request $request){
    //dd('hello');
$request->validate([
    'name' => 'required|regex:/^[a-zA-Z ]+$/',
    'email' => 'required|email|unique:user_profiles',
    'mobile' => 'required|digits:10',
    'profile_pic' => 'nullable|mimes:png,jpg,jpeg',
    'password' => 'required|min:6'
]);

if ($request->hasFile('profile_pic')) {
    $path = $request->file('profile_pic')->store('profiles','public');
}

$response  = UserProfile::create([
 'name' => $request->name,
 'email' => $request->email,
 'mobile' => $request->mobile,
 'profile_pic' => $path ?? null,
 'password' => bcrypt($request->password),
]);
if($response){
return  back()->with(['message'=>'create successfully'], 200);
}else{
    return back()->with(['error'=>'not registered']);
}

}


public function edit($id){

   $user = UserProfile::find($id);

return view('users.edit',compact('user'));
}



public function update(Request $request ,$id){



if($request->new_profile_pic){
   
   \Storage::disk('public')->delete($request->profile_pic);
   //  dd($request->profile_pic);
 $path = $request->new_profile_pic->store('profiles','public');
}else{
    $path = $request->profile_pic;
}

  $data = [
          'name'=>$request->name,
          'email'=>$request->email,
           'mobile'=>$request->mobile,
           'profile_pic'=>$path ?? null
  ];

$response = UserProfile::find($id)->update($data);


if($response){
    return back()->with(['message','upadte']);
}else{
    return back()->with(['err'=>'error ']);
}

}

public function destroy($id){
  //dd($id);
     $user = UserProfile::find($id)->delete();

     if($user){
        return redirect()->route('users.index')->with(['message'=>'delete successfully']);
     }
}
   

    public function exportCsv()
{
    $users = UserProfile::all();

    $filename = "users.csv";
    $handle = fopen($filename, 'w');

    fputcsv($handle, ["ID","Name","Email","Mobile"]);

    foreach ($users as $user) {
        fputcsv($handle, [$user->id, $user->name, $user->email, $user->mobile]);
    }

    fclose($handle);

    return response()->download($filename)->deleteFileAfterSend(true);
}

}
