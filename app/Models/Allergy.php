<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;


class Allergy extends Model
{
      protected $fillable = ['id', 'patient_id', 'allergy_type', 'description'];


       public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    }
