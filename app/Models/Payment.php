<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use SoftDeletes;
       protected $fillable = [
        'id',
        'monto',
        'pay_date',
        'description',
        'pacient_id',
        'doctor_id',
    ];
    
    protected $casts = [
        'pay_date' => 'date',
        'monto' => 'decimal:2',
    ];

    // Opcional: Definir valores por defecto
    protected $attributes = [
        'status' => 'completed',
    ];
 
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'pacient_id', 'id');
    }
    public function employee()
{
    return $this->belongsTo(Employee::class, 'doctor_id');
}

// En Patient.php
public function person()
{
    return $this->belongsTo(Persons::class, 'person_id');
}



public function speciality()
{
    return $this->belongsTo(MedicalSpeciality::class, 'specialitys_id');
}

}
