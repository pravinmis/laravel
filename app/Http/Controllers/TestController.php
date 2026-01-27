<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\User;
Use App\Models\Employee;
use App\Events\UserRegister;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\File;
use App\models\Count;
use App\models\Seller;
use App\models\Order;
use Illuminate\Support\Facades\DB;
use App\models\Order_item;
use App\Events\AdminNotification;
use Laravel\Passport\PersonalAccessTokenResult;
use App\Notifications\UserRegisteredNotification;


class TestController extends Controller
{
    
    public function test(){
        
         $x = User::find(1);
          $y = new UserRegister($x);
            event($y);


        dd($y->user);

    }
    public function login(Request $request){
            try{
              $credential = $request->only('email', 'password');
            //  dd($credential);
            if(\Auth::guard('employee')->attempt($credential)){
                return response()->json('successfully');
            }else{
                return response()->json('unsuccessfully');
            }
        }catch(\Throwable $e){
            \Log::error($e->getMessage);
        }
    }


    public function role(Request $request){

          
          
      //  $permission = Permission::create(['name'=>'create employee', 'guard_name'=>'employee']);
        // $permission = Permission::create(['name'=>'edit employee', 'guard_name'=>'employee']);
        
        //   $role = Role::create(['name'=>'employee','guard_name'=>'employee']);
        // //   $role = Role::where('guard_name','employee');

        //   $role->givePermissionTo($permission);

    //    $role = Role::with('permissions')->where('name','employee')->first();
    //    dd($role);
    try{
            $emp = Employee::find(15);
              $emp->assignRole('employee');
    }catch(\Throwable $e){
        \Log::error($e->getMessage());
    }
            
      



    }

    public function count_test(Request $request){
    
        $path = $request->path();

           $data = Count::firstOrCreate(['url'=>$path]);
        //    dd($data);
           $data->hit_counts++;
           $data->save();
        dd($data->hit_counts);
    }

public function create(){
    return view('create');
}

public function store(Request $request)
{
   

     $validator =   $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);


       

        $filename = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
        }

     $user =   User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
          //  'image'    => $filename
        ]);

        
     $admin = User::where('role', 'admin')->first();
$admin->notify(new UserRegisteredNotification($user));

        return back()->with('success', 'User created successfully');

    
}



    public function index_1(){
        $user = User::get();
        return view('index_1',compact('user'));
    }

       public function edit(Request $request){
        $user = User::find($request->id);
        return view('edit',compact('user'));
    }

    public function update(Request $request){

       // dd($request->id);
     // dd($request->image);
         ;
        // dd($file,$request->image);
       if($request->new_image){
        
         $file = $request->new_image;

         // old image delete

        
        if ($request->image) {
            $oldpath = public_path('uploads/' .ltrim($request->image));
             // dd($oldpath);
            if (File::exists($oldpath)) {
                File::delete($oldpath);
            }
        }

      //  Storage::disk('public')->delete($user->image);
        
      //   $filename = time().'/'.$request->new_image->getClientOriginalName();

       //  dd($filename);
      //
      //  $file->move(public_path('uploads'), $filename);
      $filename =   $file->store('uploads','public');
      
      // $path = $file->store('public', 'uploads');
     //  $file->storeAs('public', $filename ,'uploads');

       }else{
        
        $filename = $request->image;
       }

        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'image'=>$filename,
        ];

        User::where('id',$request->id)->update($data);
      return redirect('admin/index_1')->with('message','update successfully');
         return redirect()->route('edit',$request->id)->with('message','update successfully');

    // $user   = User::firstOrCreate(['id'=>$request->id]);
  
    // $user->update(['name'=>$request->name]);

    }


    







    ////////////////////

    public function order(){

               

    $total =    User::join('orders','users.id','=','orders.user_id')
               ->join('order_items','orders.id','=','order_items.order_id')
               ->groupBy('users.name')
                ->select('users.name',DB::raw('SUM(order_items.quantity) as total_quantity'))
                ->get();


            //    dd($total);


            $join = User::join('orders','users.id','=','orders.user_id') 
                     
                    ->where('orders.order_date','<',now()->subDays(7))
                    ->get();
                    
            //        dd($join);


                    
          $salary = DB::table('departments')->rightjoin('employees','departments.id','=','employees.dept_id')
                    // ->groupBy('departments.dept_name','employees.name')
                    // ->select('departments.dept_name','employees.name',DB::raw('MAX(employees.salary) as max_salry'))

                    ->get();

               //     dd($salary);

$data = DB::table('departments')->join('employees', 'departments.id', '=', 'employees.dept_id')
    ->whereIn('employees.salary', function ($query) {
        $query->select(DB::raw('MAX(salary)'))
              ->from('employees')
              ->groupBy('dept_id');
              
    })
    ->select(
        'departments.dept_name',
        'employees.name',
        'employees.salary'
    )
    ->get();


                   dd($data);


                    // $user = Order::whereNotIn('id',[1,3])->get();
                    //  $users = Order::whereBetween('id',[1,3])->get();


                    //dd($user,$users);
    }



    public function countinglogin(Request $request){
        $user = User::where('email',$request->email)->first();

        if(!Hash::check($user->password,$request->password)){
            $user->count++;
            $user->save();
        }

        
    

    if($user->count > 3){
        return response()->json('not attempts');
    }

    }
    public function register(Request $request){

         $user = Employee::create([
            'name' => "roshan",
            'email'=> "roshan@gmail.com",
            'password' => "roshan@123",
            
        ]);

        // if(!$user){
        //     throw new Exception('incorrect ......');
        // }

       // dd($user);
        // Option A: Personal Access Token
        $tokenResult = $user->createToken('Personal Access Token'); // scopes optional: ['view-orders']
        $token = $tokenResult->accessToken;

    }
}
