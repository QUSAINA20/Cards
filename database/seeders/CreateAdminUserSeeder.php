<?php

namespace Database\Seeders;

use App\Models\{Admin,User};
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{Role,Permission};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create([
            'name' => 'Ammar Hasan',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin@admin.com'),
            'status' => true,
            'phone' => '+963 123456789',
        ]);

        //create role
        $role = Role::create(['guard_name' => 'admin-api', 'name' => 'admin']);

        $permissions = Permission::where('guard_name','admin-api')->pluck('id','id');

        $role->syncPermissions($permissions);

        $admin->assignRole('admin');


        $user = User::create([
            'name' => 'Ammar',
            'email' => 'user@admin.com',
            'password' => bcrypt('user@admin.com'),
            'status' => true,
            'phone' => '+963 123456789',
            'balance' => 0,
        ]);
        $role2 = Role::create(['guard_name' => 'user-api', 'name' => 'user']);

        $permissions_user = Permission::where('guard_name', 'user-api')->pluck('id', 'id');

        $role2->syncPermissions($permissions_user);

        $user->assignRole('user');
    }
}
