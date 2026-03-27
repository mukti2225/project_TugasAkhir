<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate([
            'email' => 'admin@gmail.com',
        ], 
        
        [
            'name' => 'Admin',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('admin');
    }
}
