<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeContractTypes extends Model
{

    protected $fillable = [
        'name',
        'description',
        'headquarter_id'
       ];

         public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
