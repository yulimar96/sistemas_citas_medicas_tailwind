<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organizational extends Model
{
     protected $fillable = [
        'name',
        'status',
       
    ];
       public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

 public function headquarters()
    {
        return $this->hasMany(Headquarter::class);
    }
  public function unitTypes()
    {
        return $this->hasMany(OrganizationalUnitTypes::class, 'organizational_id'); // Asegúrate de que 'organizational_id' sea la clave foránea en la tabla 'organizational_unit_types'
    }
     /**
     * Relación con el gerente de la unidad
     */
// Relación con el líder actual (versión segura)
public function currentLeader()
{
    return optional($this->leadersQuery()->first())->load('person');
}

// Relación base para líderes (más confiable)
// app/Models/OrganizationalUnit.php

public function leaders()
{
    return $this->belongsToMany(Employee::class, 'organizational_unit_members')
        ->wherePivot('is_leader', true)
        ->where(function($query) {
            $query->whereNull('end_date')
                  ->orWhere('end_date', '>', now());
        })
        ->orderBy('pivot_start_date', 'desc')
        ->withPivot(['start_date', 'end_date'])
        ->with('person');
}
}
