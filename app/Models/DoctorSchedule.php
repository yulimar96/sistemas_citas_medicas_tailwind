<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'day',
        'start_time',
        'closing_time',
        'shift',
        'status',
        'organization_unit_id'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'doctor_id'); 
    }
         public function organizationalUnit()
    {
        return $this->belongsTo(OrganizationalUnit::class, 'organization_unit_id');
    }
    public function specialitys()
    {
        return $this->belongsTo(MedicalSpeciality::class,'specialitys_id', 'id');
    }

     public function event()
    {
        return $this->hasMany(Event::class); 
    }
}
