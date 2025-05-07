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
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->string('title', 100); // Aumenté la longitud
        $table->dateTime('start'); // Cambiado a dateTime
        $table->dateTime('end');   // Cambiado a dateTime
        $table->time('time');
        $table->string('note', 100)->nullable();
        $table->string('color', 50)->nullable(); // Aumenté la longitud
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('doctor_id')->constrained('employees')->onDelete('cascade');
        $table->foreignId('organizational_unit_id')->constrained('organizational_units')->onDelete('cascade');
$table->string('status', 20)->default('pendiente');         $table->softDeletes();
        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
