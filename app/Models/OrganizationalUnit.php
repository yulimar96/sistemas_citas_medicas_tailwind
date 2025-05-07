<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\OrganizationalUnitTypes;
use App\Models\OrganizationalUnitMember;

class OrganizationalUnit extends Model
{
   use HasFactory;

    protected $fillable = ['name', 'organizational_unit_types_id', 'headquarter_id','status'];

       public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

   public function unitType()
    {
        return $this->belongsTo(OrganizationalUnitTypes::class);
    }
    
      public function OrganizationMembrer()
    {
        return $this->belongsTo(OrganizationalUnitMember::class);
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
    
    public function doctorSchedules()
    {
        return $this->hasMany(DoctorSchedule::class);
    }

        public function headquarter()
    {
        return $this->belongsTo(Headquarter::class);
    }
    
            public function event()
    {
        return $this->hasMany(Event::class);
    }
   /**
     * Relación con los líderes/encargados de la unidad
     */
public function leaders()
{
    return $this->belongsToMany(Employee::class, 'organizational_unit_members')
        ->using(OrganizationalUnitMember::class)
        ->wherePivot('is_leader', true)
        ->where(function($query) {
            $query->whereNull('end_date')
                  ->orWhere('end_date', '>', now());
        })
        ->orderBy('start_date', 'desc')
        ->withPivot(['start_date', 'end_date'])
        ->with(['person:id,name']); // Optimización clave
}
public function currentLeader()
{
    return $this->leaders()
        ->where(function($query) {
            $query->whereNull('organizational_unit_members.end_date')
                  ->orWhere('organizational_unit_members.end_date', '>', now());
        })
        ->first();
}

}
