<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $permissions = [
            "Permission-List",
            "Create-Permission",
            "Update-Permission",
            "Create-User",
            " Update-User ",
            "create-sale",
         ];
         foreach ($permissions as $permission) {
            Permission::create(['guard_name' => 'admin-api','name' => $permission]);
       }
       //user
         $permissions_user = [
            "update-sale",
         ];
         foreach ($permissions_user as $permission) {
            Permission::create(['guard_name' => 'user-api' ,'name' => $permission]);
       }






    }
}
