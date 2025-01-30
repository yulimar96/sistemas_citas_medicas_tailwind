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
        Schema::create('secretariets', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100);
        $table->string('last_name', 100);
        $table->string('email', 100)->unique();
        $table->string('birthdate');
        $table->string('nacionality');
        $table->string('identification_number');
        $table->string('address', 100);
        $table->string('code_area');
        $table->string('phone');
        $table->string('status')->default('active');
        $table->unsignedInteger('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('secretariets');
    }
};
