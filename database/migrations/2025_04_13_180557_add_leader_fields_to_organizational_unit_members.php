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
    Schema::table('organizational_unit_members', function (Blueprint $table) {
        if (!Schema::hasColumn('organizational_unit_members', 'is_leader')) {
            $table->boolean('is_leader')->default(false)
                ->after('organizational_unit_id')
                ->comment('True si es el encargado del área');
        }

        if (!Schema::hasColumn('organizational_unit_members', 'start_date')) {
            $table->date('start_date')->nullable()
                ->after('is_leader')
                ->comment('Fecha cuando asumió el cargo');
        }

        if (!Schema::hasColumn('organizational_unit_members', 'end_date')) {
            $table->date('end_date')->nullable()
                ->after('start_date')
                ->comment('Fecha cuando dejó el cargo (null si es actual)');
        }
    });
}
public function down()
{
    Schema::table('organizational_unit_members', function (Blueprint $table) {
        $table->dropColumn(['is_leader', 'start_date', 'end_date']);
    });
}
};
