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
        Schema::create('allergies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->nullable()->constrained('patients')->onDelete('cascade'); // Relación con pacientes
            $table->string('allergy_type', 100);
              $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->text('description')->nullable(); // Descripción adicional de la alergia//'Reacción alérgica al polen de gramíneas',
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('allergies');
    }
};
