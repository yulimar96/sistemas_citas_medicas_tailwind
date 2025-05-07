<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrganizationalUnit;


class OrganizationalUnitTypes extends Model
{
    use HasFactory;

    protected $table = 'organizational_unit_types';

      public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    
    public function organizational()
    {
        return $this->belongsTo(Organizational::class);
    }

    public function headquarters()
    {
        return $this->belongsTo(Headquarter::class);
    }

        public function units()
    {
        return $this->hasMany(OrganizationalUnit::class);
    }

       public function employee()
    {
        return $this->hasMany(Employee::class);
    }



}
