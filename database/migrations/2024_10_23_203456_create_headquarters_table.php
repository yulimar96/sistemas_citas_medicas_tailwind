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
        Schema::create('headquarters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->foreignId('organizational_id')->nullable()->constrained('organizationals')->onDelete('cascade');
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('headquarters');
    }
};
