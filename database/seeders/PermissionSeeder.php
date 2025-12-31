<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // create permissions
        Permission::firstOrCreate(['name' => 'create articles']);
        Permission::firstOrCreate(['name' => 'edit articles']);
        Permission::firstOrCreate(['name' => 'delete articles']);
        // Permission::firstOrCreate(['name' => 'update articles']);

        // // create roles and assign permissions
        // $writer = Role::firstOrCreate(['name' => 'writer']);
        // $writer->givePermissionTo(['create articles','edit articles']);

        // $media = Role::firstOrCreate(['name' => 'media']);
        // $media->givePermissionTo(['update articles']);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());
    }
}

