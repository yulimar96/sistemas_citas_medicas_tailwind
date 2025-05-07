<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('parishes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
             $table->foreignId('municipality_id')->constrained('municipalities')->onDelete('cascade')->nullable();
            
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('parishes');
    }
};
