<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('organizational_units', function (Blueprint $table) {
        // Índice automático (Llave primaria)
        $table->id(); 

        // Índice para búsquedas rápidas por nombre (¡Bien colocado!)
        $table->string('name')->index();  // 👈 Más elegante que poner $table->index('name') aparte

       $table->integer('ability');
        $table->date('since');
        $table->string('location');
        
        // Índice para búsquedas por teléfono (si es frecuente)
        $table->string('phone_area_codes', 7)->index();  // 👈 Nuevo índice
        $table->string('phone_number', 7);
        
        $table->string('specialitys');
        
        // Índice automático en foreign key (Laravel lo hace por ti)
        $table->foreignId('organizational_unit_types_id')->constrained();
        
        $table->string('description', 100)->nullable();  // 👈 Corregido "nulleable" a "nullable"
        $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
        
        // Índice para filtrar por estado (si es común)
        $table->index('status');  // 👈 Útil si haces muchos WHERE status = 'active'
        
        $table->timestamps();
        
        // Índice compuesto (opcional, si buscas por nombre + estado)
        $table->index(['name', 'status']);  // 👈 Para consultas como WHERE name = 'X' AND status = 'active'
    });
}
    public function down(): void
    {
        Schema::dropIfExists('organizational_units');
    }
};