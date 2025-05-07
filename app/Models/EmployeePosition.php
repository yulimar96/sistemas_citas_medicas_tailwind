<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;


class EmployeePosition extends Model
{
    protected $table = 'employee_positions';
     protected $fillable = [
        'name',
        'description',
        'status'
       ];

         public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

      /**
     * Obtiene el ID del puesto de Gerente
     */
      public static function getGerenteId()
    {
        return cache()->rememberForever('position_gerente_id', function() {
            return static::where('name', 'Gerente')->value('id');
        });
    }

    
    /**
     * Borra el caché cuando se actualiza un puesto
     */
     protected static function booted()
    {
        static::updated(function ($position) {
            if ($position->name === 'Gerente') {
                Cache::forget('employee_position_gerente_id');
            }
        });
    }
}
