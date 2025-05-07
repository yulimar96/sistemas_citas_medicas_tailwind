<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
     use HasFactory;
       protected $fillable = [
        'id',
        'title',
        'start',
        'end',
        'time',
        'color',
        'user_id',
        'doctor_id',
        'organizational_unit_id'
    ];
     use SoftDeletes;
    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'status' => 'string'
    ];
  
        
       public function person()
    {
        return $this->belongsTo(Persons::class); 
    }
        public function user()
    {
        return $this->belongsTo(User::class); 
    }
        public function organization_unit()
    {
        return $this->belongsTo(OrganizationaUnit::class); 
    }
     public function doctorSchedule()
    {
        return $this->belongsTo(DoctorSchedule::class); 
    }
public function doctor()
{
    return $this->belongsTo(Employee::class, 'doctor_id')->with('speciality');
}
    
}

