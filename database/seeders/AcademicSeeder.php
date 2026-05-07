<?php

namespace Database\Seeders;

use App\Models\Carrera;
use App\Models\Materia;
use App\Models\Periodo;
use App\Models\Role;
use App\Models\Seccione;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AcademicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crear el Periodo Académico Activo
        $periodo = Periodo::firstOrCreate(
            ['name' => '2026-1'],
            [
                'fecha_inicio' => now()->startOfMonth(),
                'fecha_fin' => now()->addMonths(6)->endOfMonth(),
                'activo' => true,
            ]
        );

        // 2. Crear Profesor de Prueba
        $profesorRole = Role::firstOrCreate(['name' => 'profesor'], ['descripcion' => 'Profesor']);
        $profesor = User::firstOrCreate(
            ['email' => 'profesor@test.com'],
            [
                'name' => 'Profesor Prueba',
                'password' => Hash::make('password'),
                'role_id' => $profesorRole->id,
                'cedula' => '11223344',
                'telefono' => '04140000000',
                'email_verified_at' => now(),
            ]
        );

        // 3. Crear Carreras y Materias
        $carrerasData = [
            'Odontología' => [
                ['name' => 'Anatomía Humana', 'codigo_materia' => 'ODO-101', 'credito_materia' => 4, 'obligatoria' => true],
                ['name' => 'Biomateriales Dentales', 'codigo_materia' => 'ODO-102', 'credito_materia' => 3, 'obligatoria' => true],
                ['name' => 'Fisiología', 'codigo_materia' => 'ODO-103', 'credito_materia' => 4, 'obligatoria' => true],
            ],
            'Economía' => [
                ['name' => 'Microeconomía I', 'codigo_materia' => 'ECO-101', 'credito_materia' => 4, 'obligatoria' => true],
                ['name' => 'Matemáticas Financieras', 'codigo_materia' => 'ECO-102', 'credito_materia' => 3, 'obligatoria' => true],
                ['name' => 'Contabilidad Básica', 'codigo_materia' => 'ECO-103', 'credito_materia' => 3, 'obligatoria' => true],
            ],
            'Educación' => [
                ['name' => 'Psicología Educativa', 'codigo_materia' => 'EDU-101', 'credito_materia' => 3, 'obligatoria' => true],
                ['name' => 'Didáctica General', 'codigo_materia' => 'EDU-102', 'credito_materia' => 4, 'obligatoria' => true],
                ['name' => 'Sociología de la Educación', 'codigo_materia' => 'EDU-103', 'credito_materia' => 3, 'obligatoria' => true],
            ]
        ];

        $horarios = [
            'Lunes y Miércoles 8:00 AM - 10:00 AM',
            'Martes y Jueves 10:00 AM - 12:00 PM',
            'Viernes 8:00 AM - 12:00 PM'
        ];

        foreach ($carrerasData as $carreraName => $materias) {
            $carrera = Carrera::firstOrCreate(['name' => $carreraName]);

            foreach ($materias as $index => $materiaData) {
                // Crear la materia
                $materia = Materia::firstOrCreate(
                    ['codigo_materia' => $materiaData['codigo_materia']],
                    $materiaData
                );

                // Asociar materia a carrera (si no está asociada ya)
                $carrera->materias()->syncWithoutDetaching([$materia->id]);

                // 4. Crear una Sección para esta materia en este periodo
                Seccione::firstOrCreate(
                    [
                        'materia_id' => $materia->id,
                        'periodo_id' => $periodo->id,
                    ],
                    [
                        'profesor_id' => $profesor->id,
                        'cupo_maximo' => 30,
                        // Asignamos un horario simple basado en el índice para variar
                        'horario' => $horarios[$index % count($horarios)], 
                    ]
                );
            }
        }
    }
}
