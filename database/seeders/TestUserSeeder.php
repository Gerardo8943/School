<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    $adminRole = Role::where('name', 'admin')->first();
    $studentRole = Role::where('name', 'estudiante')->first();

    User::create([
        'name' => 'Gerardo Test',
        'email' => 'admin@test.com',
        'password' => Hash::make('password'),
        'role_id' => $adminRole->id,
    ]);

    User::create([
        'name' => 'Anibal Test',
        'email' => 'estudiante@test.com',
        'password' => Hash::make('password'),
        'role_id' => $studentRole->id,
    ]);
    }
}
