<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Seller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  Permission::create(['name'=>'create seller','guard_name'=>'seller']);
        //  permission::create(['name'=>'edit seller','guard_name'=>'seller']);
        //  permission::create(['name'=>'delete seller','guard_name'=>'seller']);

        // $role = Role::create(['name'=>'seller','guard_name'=>'seller']);
        // $role->givePermissionTo(['create seller','edit seller','delete seller']);

        $seller = Seller::find(1);
        $seller->assignRole('seller');
      //  $seller->givePermissionTo(['create sellers']);

    }
}
