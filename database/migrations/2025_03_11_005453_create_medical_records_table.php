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
    Schema::create('medical_records', function (Blueprint $table) {
        $table->id();
        $table->text('treatment');
        $table->text('diagnosis');
        
        // Relaciones
        $table->foreignId('patient_id')
              ->nullable()
              ->constrained('patients')
              ->onDelete('cascade');
              
        $table->foreignId('doctor_id')
              ->nullable()
              ->constrained('employees')
              ->onDelete('cascade');
        
        $table->enum('status', ['active', 'archived'])
              ->default('active');
        
        // Campos de auditoría
        $table->timestamp('completed_at')->nullable();
        $table->foreignId('created_by')->constrained('users');
        
        $table->timestamps();
        
        // Índices con nombres explícitos para evitar el error
        $table->index(['patient_id', 'created_at'], 'medical_records_patient_created_index');
        
        // FullText index con nombre explícito
        $table->fullText(['treatment', 'diagnosis'], 'medical_records_fulltext');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
