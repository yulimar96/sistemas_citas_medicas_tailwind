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
        Schema::create('medical_appointments', function (Blueprint $table) {
            $table->id();
            $table->string('appoinment_date');
            $table->string('headquarter');
            $table->string('medical_speciality');
            $table->string('doctor_id');
            $table->string('patient_id');
            $table->boolean('cofirmed')->default(true);
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_appointments');
    }
};
