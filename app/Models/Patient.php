<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Persons;
use App\Models\Allergy;

class Patient extends Model
{
    protected $fillable = [
    'person_id',
    'medical_history'];

    public function person()
    {
        return $this->belongsTo(Persons::class, 'person_id', 'id');
    }
      public function allergies()
    {
        return $this->hasMany(Allergy::class);
    }
     public function pay()
    {
        return $this->hasMany(Payment::class);
    }
    
}
