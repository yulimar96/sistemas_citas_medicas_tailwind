<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Persons;
use App\Models\MedicalSpeciality;

class Doctor extends Model
{
    protected $table = 'employees';
    protected $fillable = [
        'person_id','employee_type',
        'medical_license', 
        'specialitys_id',
        'employee_contract_types_id',
        'potition_id',
        'organizational_unit_types_id','schedule_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function person()
    {
        return $this->belongsTo(Persons::class, 'person_id', 'id');
    }

    public function specialitys()
    {
        return $this->belongsTo(MedicalSpeciality::class,'specialitys_id', 'id');
    }

     public function doctorSchedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id'); 
    }

}