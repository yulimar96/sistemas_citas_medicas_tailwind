<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('municipalities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('federal_states_id')->constrained('federal_states')->onDelete('cascade')->nullable();
           
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('municipalities');
    }
};
