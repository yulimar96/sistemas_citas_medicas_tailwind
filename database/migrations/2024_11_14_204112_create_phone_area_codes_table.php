<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('phone_area_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code',50);
           $table->foreignId('federals_state_id')->constrained('federal_states')->onDelete('cascade')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('phone_area_codes');
    }
};
