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
      Schema::create('employee_contract_types', function (Blueprint $table) {
    $table->id();
    $table->string('name', 200)->index(); // ✅ Índice
    $table->string('description', 200);
    $table->foreignId('headquarter_id')->constrained()->cascadeOnDelete();
    $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
    $table->timestamps();
    
    $table->index(['headquarter_id', 'status']); // ✅ Para búsquedas por sede + estado
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_contract_types');
    }
};
