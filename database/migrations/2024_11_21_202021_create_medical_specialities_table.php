<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medical_specialities', function (Blueprint $table) {
            $table->id();
            $table->string('name',200); // Campo para el nombre de la especialidad
            $table->string('description',200);
              $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('medical_specialities');
    }
};
