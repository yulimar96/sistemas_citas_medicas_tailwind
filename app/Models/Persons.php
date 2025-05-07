<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Secretariat;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;

class Persons extends Model
{
    protected $table = 'peoples';
       protected $fillable = [
        'id',
        'name_1',
        'name_2',
        'surname_1',
        'surname_2',
        'sex',
        'birth_date',
        'blood_type',
        'nacionality',
        'identification_number',
        'phone_area_codes',
        'phone_number',
        'cell_phone_area_codes',
        'cellphone_number',
        'federals_state_id',
        'municipalities_id',
        'parish_id',
        'room_type',
        'level_of_education',
        'user_id',
    ];
     public function user()
    {
        return $this->hasOne(User::class, 'id'); 
    }
        public function employee()
    {
        return $this->hasOne(Employee::class);
    }
    public function patient()
    {
        return $this->hasOne(Patient::class, 'person_id', 'id');
    }

    protected $appends = ['age', 'formatted_birth_date'];

    public function getAgeAttribute()
    {
        if (!$this->birth_date) return null;

        return Carbon::parse($this->birth_date)->age;
    }

    public function getFormattedBirthDateAttribute()
    {
        return $this->birth_date
            ? Carbon::parse($this->birth_date)->format('d/m/Y')
            : null;
    }
        public function event()
    {
        return $this->hasMany(Event::class);
    }
    
}
