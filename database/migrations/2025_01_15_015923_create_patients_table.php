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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->nullable()->constrained('peoples')->onDelete('cascade');
            $table->string('medical_history',100)->nullable()->index();
            $table->date('registration_date'); // Fecha de registro
            $table->date('last_visit'); 
            $table->boolean('has_allergies')->default(false); // Cambiar a booleano
            $table->string('allergy_type', 100)->nullable(); // Cambiar el nombre a allergy_type
            $table->text('observation',100)->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
