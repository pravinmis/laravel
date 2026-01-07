<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // create permissions
    //  $dashboard =    Permission::firstOrCreate(['name' => 'dashboard']);
    //   $postView =    Permission::firstOrCreate(['name' => 'post.view']);
    //   $postCreate =   Permission::firstOrCreate(['name' => 'post.create']);

//        $Createcategory  = Permission::firstOrCreate(['name' => 'category.create']);
       
//  $Listcategory  = Permission::firstOrCreate(['name' => 'category.list']);


       
        // Permission::firstOrCreate(['name' => 'update articles']);

        // // create roles and assign permissions
    //    $user = Role::firstOrCreate(['name' => 'user']);
    //     $user->givePermissionTo(['category.create']);

        $user = User::find(1);
        $user->givePermissionTo(['category.list']);

        //  $seller = Role::firstOrCreate(['name' => 'seller']);
        //  $seller->givePermissionTo(['dashboard','post.view']);

        //  $admin = Role::firstOrCreate(['name' => 'admin']);
        // $admin->givePermissionTo(Permission::all());
    }
}

