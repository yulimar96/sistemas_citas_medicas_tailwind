<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrganizationalUnit;

class Headquarter extends Model
{
    protected $table = 'headquarters'; //
  public function organization()
{
    return $this->belongsTo(Organizational::class, 'organizational_id');
}
 public function unitTypes()
    {
        return $this->hasMany(OrganizationalUnitTypes::class, 'headquarter_id'); // Asegúrate de que 'headquarter_id' sea la clave foránea en la tabla 'organizational_unit_types'
    }

    public function organizationalUnits()
    {
        return $this->hasMany(OrganizationalUnit::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
     public function unit()
    {
        return $this->hasMany(OrganizationalUnit::class, 'headquarter_id'); // Asegúrate de que 'headquarter_id' sea la clave foránea en la tabla 'organizational_unit_types'
    }
}
