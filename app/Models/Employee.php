<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'employee_type', // 'doctor', 'secretary', 'nurse', etc.
        'hire_date',
        'schedule_id',
        'medical_license',
        'specialitys_id',
        'employee_contract_types_id',
        'employee_position_id',
        'organizational_unit_types_id',
        'status'
    ];
       public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Relación con Persona
    public function person()
    {
        return $this->belongsTo(Persons::class, 'person_id', 'id');
    }
        // Relación con Tipo de Unidad Organizativa
    public function organizationalUnitType()
    {
        return $this->belongsTo(OrganizationalUnitTypes::class, 'organizational_unit_types_id');
    }

        // Relación con Miembros de Unidad
    public function unitMemberships()
    {
        return $this->hasMany(OrganizationalUnitMember::class, 'employee_id');
    }

 
    // Relación con Tipo de Contrato
    public function contractType()
    {
        return $this->belongsTo(EmployeeContractTypes::class, 'employee_contract_types_id');
    }

    // Relación con Posición/Cargo
    public function position()
    {
        return $this->belongsTo(EmployeePosition::class, 'employee_position_id');
    }

 
    // Relación con Horario General
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
        public function speciality()
    {
        return $this->belongsTo(MedicalSpeciality::class,'specialitys_id', 'id');
    }

    // Relación con Horarios Especiales (doctores)
     public function doctorSchedules()
    {
        return $this->hasMany(DoctorSchedule::class, 'doctor_id')
            ->where('status', 'active')
            ->orderByRaw("FIELD(day, 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')")
            ->orderBy('start_time');
    }
    public function event()
    {
        return $this->hasMany(Event::class, 'doctor_id');
    }

    // Accesor para nombre completo
    public function getFullNameAttribute()
    {
        return $this->person->name_1 . ' ' . $this->person->surname_1;
    }
       // Relación con Unidades a través de miembros
    public function units()
    {
        return $this->belongsTo(OrganizationalUnit::class, 'organization_unit_id');
    }

    public function organizationalUnits()
    {
        return $this->belongsToMany(OrganizationalUnit::class, 'organizational_unit_members')
            ->using(OrganizationalUnitMember::class)
            ->withPivot(['is_leader', 'start_date', 'end_date']);
    }

         public function scopeDoctors($query)
    {
        return $query->where('employee_type', 'doctor');
    }
    
  // Define scope for secretariat employees
    public function scopeSecretariat($query)
    {
        return $query->where('employee_type', 'secretariat');
    }
       public function pay()
    {
        return $this->hasMany(Payment::class);
    }
}

