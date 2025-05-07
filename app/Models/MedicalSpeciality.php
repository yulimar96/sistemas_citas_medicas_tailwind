<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalSpeciality extends Model
{
    protected $fillable = [
        'name',
        'active',
    ];

     public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }


    // Relación con el modelo Employee
    public function employee() {
        return $this->hasMany(Employee::class, 'specialitys_id'); 
    }

      public function doctor() {
        return $this->hasMany(Doctor::class); 
    }
    

}