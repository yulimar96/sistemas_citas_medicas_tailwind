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
        Schema::create('peoples', function (Blueprint $table) {
            $table->id();
            $table->string('name_1', 20);
            $table->string('name_2', 20)->nullable();
            $table->string('surname_1', 20);
            $table->string('surname_2', 20)->nullable();
            $table->date('birth_date');
            $table->boolean('sex')->default(true);
            $table->string('blood_type', 20);
            $table->string('nacionality');
            $table->string('identification_number', 9);
            $table->string('phone_area_codes', 7);
            $table->string('phone_number', 7);
            $table->string('cell_phone_area_codes', 7);
            $table->string('cellphone_number', 7)->index();
            $table->foreignId('federals_state_id')->constrained('federal_states')->onDelete('cascade');
            $table->foreignId('municipalities_id')->constrained('municipalities')->onDelete('cascade');
            $table->foreignId('parish_id')->constrained('parishes')->onDelete('cascade')->nullable();
            $table->boolean('is_employee')->default(true);
            // $table->foreignId('cities_id')->constrained('cities')->onDelete('cascade')->nullable();
            $table->string('room_type', 100);
             $table->string('level_of_education', 100);
              $table->enum('status', ['active', 'inactive', 'suspended'])->default('active')->index();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['nacionality', 'identification_number'])->index();
            $table->index(['is_employee', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peoples', function (Blueprint $table) {
        $table->dropColumn('identity_number');
    });
    }
};
