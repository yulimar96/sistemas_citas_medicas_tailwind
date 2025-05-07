<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Parish;
class Municipality extends Model
{

       protected $fillable = [
        'id',
        'federal_states_id',
        'name'];

    public function parishes()
    {
        return $this->hasMany(Parish::class, 'municipality_id');
    }
}
