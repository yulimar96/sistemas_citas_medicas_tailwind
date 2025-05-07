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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('peoples')->onDelete('cascade');
            $table->string('employee_type');
            $table->date('hire_date'); // Fecha de contratación
            $table->foreignId('schedule_id')->nullable()->constrained();
            $table->string('medical_license')->nullable()->unique();
            $table->foreignId('specialitys_id')->nullable()->constrained('medical_specialities')->onDelete('cascade');
            $table->foreignId('employee_contract_type_id')->constrained('employee_contract_types')->onDelete('cascade');
            $table->foreignId('employee_position_id')->constrained('employee_positions')->onDelete('cascade');
            $table->foreignId('organizational_unit_type_id')->constrained('organizational_unit_types')->onDelete('cascade'); 
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamps();

             $table->index(['organizational_unit_type_id', 'status']);
    $table->index(['speciality_id', 'employee_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
