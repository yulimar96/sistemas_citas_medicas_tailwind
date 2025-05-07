<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrganizationalUnit;
use App\Models\Schedule;

class OrganizationalUnitMember extends Model
{
     use HasFactory;

    protected $table = 'organizational_unit_members';
    protected $fillable = [
    'employee_id',
    'organizational_unit_id',
    'is_leader',
    'start_date',
    'end_date'
];

    public function unit()
    {
        return $this->belongsTo(OrganizationalUnit::class);
    }

    public function headquarter()
    {
        return $this->belongsTo(Headquarter::class);
    }
     public function employeePosition()
    {
        return $this->belongsTo(EmployeePosition::class);
    }

}
