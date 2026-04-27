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

    User::forceCreate([
        'name' => 'Gerardo Test',
        'email' => 'admin@test.com',
        'password' => Hash::make('password'),
        'role_id' => $adminRole->id,
        'cedula' => '12345678',
    ]);

    User::forceCreate([
        'name' => 'Anibal Test',
        'email' => 'estudiante@test.com',
        'password' => Hash::make('password'),
        'role_id' => $studentRole->id,
        'cedula' => '87654321',
    ]);
    }
}
