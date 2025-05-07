<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrganizationalUnitMember extends Pivot
{
    protected $table = 'organizational_unit_members';

    protected $casts = [
        'is_leader' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    // Si necesitas funcionalidad adicional, puedes añadir estos métodos
    public function getIsCurrentAttribute()
    {
        return is_null($this->end_date) || $this->end_date > now();
    }
}