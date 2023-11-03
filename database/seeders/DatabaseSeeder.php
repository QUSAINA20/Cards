<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Sale;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Sale::factory()->create();
        $this->call([
            RolePermissionSeeder::class,
            CreateAdminUserSeeder::class,
           // HomeSeeder::class,
        ]);
    }
}
