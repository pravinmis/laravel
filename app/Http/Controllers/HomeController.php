<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Post;
use App\models\Categorie;
use App\models\User;
use App\models\Profile;
use App\models\Seller;
use App\models\Count;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use App\Helpers\helpers;
use App\Helpers\fun;
use App\Mytrait;
use App\Events\UserRegister;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\jobs\SendWelcomeEmail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
   Use Mytrait;

     public function home(Request $request){
          //   dd('hello');
          //trait  
          //  $x =  $this->hello();  
          //   dd($x);
            

            //helper
              //    dd(passwords());
          // die;

          try{
               // $request->validate([
                     
               //      'name'=>'required',
               //      'email'=>'required|unique'
               // ]);

               
         // dd($request->search);
    // dd('hello');
    //  ONE TO ONE 
//  $user= User::with('profile')->find(1);
//  dd($user->profile->address);
      
//        $userss = new WelcomeMail($user);
       
//     die;
//           Mail::to($user->email)->send(new WelcomeMail($user));
      
     //   $users = Profile::with('user')->find(1);
//      dd($users->user->email);

//        foreach($user as $u){
//           echo $u->profile->address;          
//        }
// die;
     // dd($user);

     //  if($user->profile){
     //      echo "radhe radhe";
     //  }

//       $user = DB::table('users')
//       ->join('profiles','users.id','=','profiles.user_id')
//       ->where('users.id',1)
//       ->first();
         
//  dd($user);


      //one to many

     //  $seller = Seller::find(1);
     // $seller = Seller::with('posts')->get();
//      $post = Post::with('seller')->get();
//    // dd($post);
//        foreach($post as $p){
//           echo $p;
//        }

//      foreach ($post as $p){
//           echo $p;
//      }
//      die;
//       foreach($seller as $s){
//   foreach(  $s->posts as $p){
//      echo $p->title;
//   }
//       }

   // $user = User::with('posts')->get();

    // $post = Post::with('user')->get();
       
// dd($user);
        //   foreach($user as $p){
        //  echo  $p->name."<br>";

        // //    dd($p->posts);
        //     foreach($p->posts as $u){
        //       echo $u->title;
        //     }
        //   }

// foreach($user->posts as $u){
//      echo $u;
// }

   // die;

//        $user = User::withCount('posts')->get();
//      foreach($user as  $u){
//       $user->posts  = Post::where('user_id',$u->id)->get();
//      }

//        foreach($user as $u){
//     echo $u->name."Br..............//.....";

//     foreach($u->posts as $post){
//         echo $post->title . "<br>";
//     }
// }

     //  $user = User::has('posts','>',7)->get();
     // dd($user);
   //  $user = Post::whereHas('user',fn($q)=>$q->where('name','pravinm'))->get();
     //  dd($user);

     //   $user = DB::table('posts')
     //   ->join('users','posts.user_id','=','users.id')
     //   ->get();
     
     // $user = User::select('name', DB::raw('COUNT(*) as counts'))
     // ->groupBy('name')
     // ->having('counts','>',1)
     // ->get();

     // dd($user);
    


//    $user = User::with('posts')
//              ->withCount('posts')
//             ->orderByDesc('posts_count')
//             ->get();



//             foreach($user  as $u){
//                 echo $u->name."<br>";
//                 foreach($u->posts as $m){
//                     echo $m->title."<br>";
//                 }
//             }

// dd($user);


//    $users = DB::table('users')
//     ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
//     ->select(
//         'users.id',
//         'users.name',
//         'users.email',
//         DB::raw('COUNT(posts.id) as posts_count'),
//         DB::raw('GROUP_CONCAT(posts.title SEPARATOR "||") as all_posts')
//     )
//     ->groupBy('users.id', 'users.name', 'users.email')
//     ->get();

//        foreach($users as $us){

//           echo $us->name."<br>";
//        $m   = explode("||", $us->all_posts);

//        foreach($m as $f){
//           echo $f."<br>";
//        }

//        }






$users = DB::table('users');

if (!empty(trim($request->search))) {
    $users = $users->where('name', 'LIKE', '%'.$request->search.'%');
}
$data = $users->get();
//  $data = $users->select('salary',DB::raw('COUNT(salary) as count_salary'))
//             ->groupBy('salary')
//             ->orderByDesc('count_salary')
//             ->first();
           
//            $datas = DB::table('employees')->where('salary', $data->salary)->get();  
//            foreach($datas as $d){
//               echo $d->name."<br>";
//            }
           
//      die;
foreach ($data as $user) {
    $user->posts = DB::table('posts')
        ->where('user_id', $user->id)
        ->get();
    $user->post_count = $user->posts->count();
}


// foreach ($users as $u){
//       echo $u->name."<br>";
//      foreach ($u->posts as $m){
//      echo $m->title."<br>";
//      }
// }

// dd($users);







     // dd($users);
     


     //   $user = User::leftjoin('posts','users.id','=','posts.user_id')
     //   ->select('users.id',DB::raw('COUNT(posts.id) as posts_count'))
     //   ->groupBy('users.id')
     //   ->orderByDesc('posts_count')
     //   //->take(3)
     //   ->having('posts_count','>',5)
     //   ->get();

       
       
       // dd($user);

     //  //many to many
     //  $post = Post::with('categories')->find(1);
     //  $posts = Post::whereHas('categories',fn($q)=>$q->where('name','tech'))->get();
     //  $cat = Category::withCount('posts')->get();


     //  $raw = DB::table('posts')
     //  ->join('category_post','posts.id','=','category_post.post_id')
     //  ->join('categories','categories.id','=','category_post.category_id')
     //  ->get();

     //  $raw = DB::table('posts')
     //  ->join('category_post','posts.id','=','category_post.post_id')
     //  ->join('categories','categories.id','=','category_post.category_id')
     //  ->select('posts.id','posts.title',DB::raw("GROUP_CONCAT(catgories.name SEPARATE ',') as categories"))
     //  ->groupBy('posts.id','posts.title')
     //  ->get();
     return response()->json(['user'=>$data]);
    //  return view('home',compact($user));
          }catch(\Exception $e){

               \Log::error($e->getMessage());

               return response()->json(['user' => 'incorrect'], 400);
          }
      
     }
 
     

     public function sendFast2Sms(Request $request)
    {
        $to = $request->input('8756233287'); // e.g. 91XXXXXXXXXX (country code optional per docs)
        $message = $request->input('message', 'Test from Fast2SMS');

        $response = Http::withHeaders([
            'authorization' => env('FAST2SMS_KEY'),
            'Content-Type'=>'application/json'
        ])->post('https://www.fast2sms.com/dev/bulkV2', [
            "route" => "v3",
            "sender_id" => "TXTIND", // example; follow provider rules
            "message" => $message,
            "language" => "english",
            "flash" => 0,
            "numbers" => $to
        ]);

         // Log full response
    \Log::info('SMS response status: '.$response->status());
    \Log::info('SMS response body: '.$response->body());

    // For debugging return to browser
    return response()->json([
        'http_status' => $response->status(),
        'body' => $response->json()
    ]);

    }

     public function create(Request $request){
   //for sms
          
 


               //  $content = \Storage::disk('public')->get('uploads/new.txt');

               //  echo $content;

  DB::beginTransaction();
try{
    


          $data = [
               'name'=>"shiva",
               'email'=>"shivkantssg64@gmail.com",
               'password'=>Hash::make("niharika"),
               
          ];

        $response = User::create($data);
        $response->posts()->create(['title'=>'hello',
        'body'=>'dfdkjhfkjhdkshfs']);

         DB::Commit();
          return response()->json(['success'=>'successfully']);

     }catch(\Throwable $e){
         DB::rollBack();
          \Log::error('error'.$e->getMessage());
         
          return response()->json('not good');
     }
      
//        //    $users = User::all();

// //          foreach($users as $u){
// // SendWelcomeEmail::dispatch($u);
// //          }
//  $user = User::firstOrCreate($data);
//  SendWelcomeEmail::dispatch($user);
     //   Mail::to($user->email)->send(new WelcomeMail($user));
     //   die;
         
            // ye queue ho laga ho tb
       //    event(new UserRegister($user));
     //      if($user){
     //    return response()->json('success');
     //      }
die;
          //one to one 
     
          // $user = User::find(1);

          // $user = auth()->id;
          // $user->profile()->create(['phone'=>'9087876399','address'=>'vainsi']);
            
     // exit;

         // one to many
     //     $user = User::find(1);
     //      $user->posts()->create(['title'=>'by','body'=>'contents']);
            
     //  $seller = Seller::find(2);
      //d($seller);
      //$seller->posts()->create(["user_id"=>"1", "title"=>"radhe","body"=>"sjdfjsdf"]);


      
      
         //many to many 
      // $post = Post::find(1);
       //dd($post);
       // $post->categories()->attach([2]); 
     //  //add krta hai
     //     die;
   //  $post->categories()->sync([3]);
      // exit;
    // $post->categories()->detach([3]);
     }


     public function counts(Request $request){

      

     $url = $request->path();
     
//      $hit = Count::firstOrCreate(['url' => $url]);
//       $hit->hit_count += 1;
//       $hit->save();
//    //  $hit->increament('hit_count');

//      dd($hit->hit_count);
     

     Product::select('products.*',DB::raw('COUNT(orders.id) as total_ordrs'))
             ->join('orders','orders.product_id' ,'=','products.id')
             ->GroupBy('products.id')
             ->orderByDesc('total_orders')
             ->take(3)
             ->get();

             $product = Product::Join('orders','products.id','=','orders.product_id')
                        ->select('products.*',DB::raw('Count(orders.id) as order_id'))
                        ->GroupBy('products.id')
                        ->OderByDesc('order_id')
                        ->take(3)
                        ->get();



}

  




       public function login(Request $request){

//     try {
//     $credentials = $request->only('email', 'password');
    
//     if (\Auth::guard('seller')->attempt($credentials)) {
//         \Log::info('hello');
//         return response()->json('successfully');
//     } else {
//         return response()->json('not successfully');
//     }
// } catch (\Throwable $e) {
//     \Log::error('errors'. $e->getMessage());
// }


  $user = User::where('email', $request->email)->first();

if ($user) {
    if (Hash::check($request->password, $user->password)) {
        // password match
     //    $user->attempts++;
     //    $user->save();
          // Login the user
       \Auth::login($user);
       //  \Session(['user'=>$user]);
         //tb auth kam krega 

        \Log::info(auth('seller')->id());

       // dd(auth()->id());
       if ($user->hasRole('admin')) {
        return redirect('/admin/dashboard');
    }

    if ($user->hasRole('seller')) {
        return redirect('/seller/dashboard');
    }

    return redirect('/dashboard'); // normal user
    
        return response()->json('successfully');
       
        // password wrong
        return response()->json('Invalid password', 401);
    }else{
     return response()->json('password wrong');
    }
} else {
    // user not found
    return response()->json('User not found', 404);
}

}







public function store(Request $request){

     $response = Http::get('https://jsonplaceholder.typicode.com/posts');
      $posts = $response->json();
       // dd($posts);
     foreach ($posts as $post) {

      //dd($post['id']);
    Post::updateOrCreate(['id' => $post['id'], 'user_id'=>$post['userId']], $post);
}
}

public function role(Request $request){

   

 Seller::create($request->all());

 die;
 $user =  User::find(1);

//  $user->givePermissionTo('create articles');
//$user->assignRole('admin');
 //$permission =  Permission::create(['name' => 'create articles', 'guard_name' => 'seller']);
 // $permission =  Permission::create(['name' => 'delete articles', 'guard_name' => 'seller']);
//   $role  = Role::create(['name'=>'Seller' , 'guard_name'=>'seller']);

//    $role->givePermissionTo('create articles','delete articles');


//  $role->givePermissionTo('create articles','even articles');

  $seller = Seller::find(1);
  
 //$seller  = $user->hasRole('history');
//   dd($user);
  $seller->assignRole('seller');
  
      //  $permission = permission::create(['name'=>'even articles']);
         
    //   $role = Role::firstOrCreate(['name'=>'history']);
    //    $role = Role::findByName('history');
   //   $role->givePermissionTo('even articles','create articles');
 //   $user->givePermissionTo(['edit articles']);
//    $role = Role::with('permissions')->where('name','history')->first();
//     dd($role);

  // \Auth::logout();
   //   \Auth::guard('seller')->logout();
  // $request->Session()->flush();
  // dd($request->Session()->flash());
//  dd(auth('seller')->id());
   // for logout 

 


//   $role = Role::with('permissions')->get();
//    foreach($role as $r){
//      echo $r->name."/";
//      foreach($r->permissions as $per){
//           echo $per->name."<br>";
//      }
//    }
 // dd($role);
}


  public function dashboard(){

      $user = User::role('user')->where('id','!=',auth()->id())->get(); // sirf user role wale
    // $user->hasRole('user');

      return view('dashboard',with(['user'=>$user]));
    }
}
