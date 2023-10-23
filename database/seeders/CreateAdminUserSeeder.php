<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
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
            'type' => 'Super',
            'status' => true,
            'phone' => '+963 123456789',
            'balance' => 0,
        ]);
    }
}
