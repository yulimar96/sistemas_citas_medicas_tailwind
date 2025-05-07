<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Municipality;
use App\Models\City;

class FederalStates extends Model
{
    protected $fillable = ['id', 'name', 'iso_3166-2'];

    /* Ralación con modelo Municipality*/
    public function municipalities(){

        return $this->hasMany(Municipality::class, 'federal_states_id');
    }
    /* Ralación con modelo City*/
    public function cities(){
        return $this->hasMany(City::class, 'federal_states_id');
    }
}
