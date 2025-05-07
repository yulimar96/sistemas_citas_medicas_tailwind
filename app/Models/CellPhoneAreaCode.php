<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class CellPhoneAreaCode extends Model
{
    protected $fillable = [
        // Código de área telefónica móvil (solo números, 3 dígitos)
        'code',
    ];
    protected $rules = [
        // Código de área telefónica debe ser obligatorio, numérico, tener 3 dígitos y ser único en la tabla phone_area_codes
        'code' => 'required|string|digits:3',
    ];
}
