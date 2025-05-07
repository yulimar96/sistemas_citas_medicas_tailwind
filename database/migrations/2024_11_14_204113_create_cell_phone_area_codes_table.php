<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cell_phone_area_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code',50);
            $table->string('description',50);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('cell_phone_area_codes');
    }
};
