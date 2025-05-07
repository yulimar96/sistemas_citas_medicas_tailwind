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
        Schema::create('doctor_schedules', function (Blueprint $table) {
    $table->id();
    $table->foreignId('doctor_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('organization_unit_id')->nullable()->constrained('organizational_units')->onDelete('cascade');
    $table->string('day')->index(); // ✅ Índice
    $table->time('start_time');
    $table->time('closing_time');
    $table->enum('shift', ['morning', 'afternoon', 'evening', 'night'])->index(); // ✅ Índice
    $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
    $table->timestamps();
    
    $table->index(['doctor_id', 'day']); // ✅ Para horarios por doctor
    $table->index(['organization_unit_id', 'status']); // ✅ Para disponibilidad por unidad
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_schedules');
    }
};
