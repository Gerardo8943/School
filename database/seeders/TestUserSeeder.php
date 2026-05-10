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

        // Usamos DB::table para evitar restricciones de mass-assignment ($guarded/$fillable)
        // ya que role_id está protegido por seguridad en el modelo User.
        \Illuminate\Support\Facades\DB::table('users')->updateOrInsert(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Gerardo Test',
                'password' => Hash::make('password'),
                'role_id' => $adminRole->id,
                'cedula' => '12345678',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        \Illuminate\Support\Facades\DB::table('users')->updateOrInsert(
            ['email' => 'estudiante@test.com'],
            [
                'name' => 'Anibal Test',
                'password' => Hash::make('password'),
                'role_id' => $studentRole->id,
                'cedula' => '87654321',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }
}
