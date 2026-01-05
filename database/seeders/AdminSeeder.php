<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Permission::create(['name'=>'create admin','guard_name'=>'admin']);
         permission::create(['name'=>'edit admin','guard_name'=>'admin']);
         permission::create(['name'=>'delete admin','guard_name'=>'admin']);

        $role = Role::create(['name'=>'admin','guard_name'=>'admin']);
        $role->givePermissionTo(['create admin','edit admin','delete admin']);
    }
}
