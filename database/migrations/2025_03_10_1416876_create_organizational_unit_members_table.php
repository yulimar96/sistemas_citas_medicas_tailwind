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
    Schema::create('organizational_unit_members', function (Blueprint $table) {
        $table->id();
        $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
        $table->foreignId('organizational_unit_id')->constrained('organizational_units')->onDelete('cascade');
        $table->timestamps();
        
        // Versión optimizada del unique
        $table->unique(
            ['employee_id', 'organizational_unit_id'],
            'ou_members_unique' // 14 caracteres vs 64+
        );
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizational_unit_members');
    }
};
