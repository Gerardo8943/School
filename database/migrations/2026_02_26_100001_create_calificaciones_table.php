<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inscripcion_id')->constrained('inscripciones')->cascadeOnDelete();
            // Optional relation to a specific task. If null, it's a general partial/final grade.
            $table->foreignId('tarea_id')->nullable()->constrained('tareas')->cascadeOnDelete();
            $table->decimal('nota', 4, 2)->nullable(); // Ej: 12.50, up to 20.00
            $table->string('tipo')->default('parcial'); // 'parcial 1', 'final', 'proyecto'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calificaciones');
    }
};
