<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneAreaCode extends Model
{
    protected $fillable = [
        'code',
        'federals_state_id',
    ];
    protected $rules = [
        'code' => 'required|string|digits:3',
    ];
}
