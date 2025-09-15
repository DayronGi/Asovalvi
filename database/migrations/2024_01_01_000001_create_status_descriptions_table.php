<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('status_descriptions', function (Blueprint $table) {
            $table->integer('status')->primary();
            $table->string('description', 100);
            $table->timestamps();
        });

        // Insert default status values
        DB::table('status_descriptions')->insert([
            ['status' => 1, 'description' => 'Inactivo'],
            ['status' => 2, 'description' => 'Activo'],
            ['status' => 3, 'description' => 'Creado'],
            ['status' => 4, 'description' => 'Realizado'],
            ['status' => 5, 'description' => 'Pendiente'],
            ['status' => 6, 'description' => 'Asignada'],
            ['status' => 7, 'description' => 'Completada'],
            ['status' => 8, 'description' => 'Rechazada'],
            ['status' => 9, 'description' => 'Eliminado'],
            ['status' => 10, 'description' => 'Activa'],
            ['status' => 11, 'description' => 'Inactiva'],
            ['status' => 12, 'description' => 'Pendiente'],
            ['status' => 13, 'description' => 'Vencida'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_descriptions');
    }
};
