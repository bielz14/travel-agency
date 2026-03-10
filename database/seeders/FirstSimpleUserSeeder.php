<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class FirstSimpleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'slime1410@gmail.com'],
            [
                'name' => 'Ilya',
                'phone' => '+380671573271',
                'password' => bcrypt('travel123'),
                'role' => User::ROLE_USER,
            ]
        );
    }
}
