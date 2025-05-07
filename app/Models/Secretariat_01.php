<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Secretariat extends Model
{
    protected $table = 'employees';
    protected $fillable = [
    'person_id', 
    'employee_type',
    'employee_contract_types_id',
    'position_id',
    'organizational_unit_types_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function person()
    {
         return $this->belongsTo(Persons::class, 'person_id');
    }
    
    public function scopeSecretariat($query)
{
    return $query->where('employee_type', 'secretariat');
}

public function scopeActive($query)
{
    return $query->where('status', 'active');
}
}