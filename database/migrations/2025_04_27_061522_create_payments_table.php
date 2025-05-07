<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        
        // Campos existentes
        $table->decimal('monto', 10, 2)
              ->comment('Monto del pago con 2 decimales de precisión');
        
        $table->date('pay_date')
              ->index()
              ->comment('Fecha en que se realizó el pago');
        
        $table->string('description', 255)
              ->nullable()
              ->comment('Descripción opcional del pago');
        
        // Relaciones
        $table->foreignId('pacient_id')
              ->constrained('patients')
              ->cascadeOnDelete()
              ->comment('Relación con el paciente');
              
        $table->foreignId('doctor_id')
              ->constrained('employees')
              ->cascadeOnDelete()
              ->comment('Relación con el doctor/empleado');
        
        // Nuevos campos
        $table->enum('status', ['completed', 'pending', 'failed', 'refunded'])
              ->default('completed')
              ->comment('Estado del pago: completed, pending, failed, refunded');
        
        $table->softDeletes()
              ->comment('Fecha de eliminación lógica (para soft deletes)');
        
        $table->timestamps();
        
        // Índices
        $table->index(['pacient_id', 'pay_date']);
        $table->index('status');
    });
}

public function down()
{
    Schema::dropIfExists('payments');
}
};
