<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Municipality;

class City extends Model
{
	  protected $fillable = ['id', 'federal_states_id', 'name', 'capital'];

    public function municipality()
    {
        return $this->belongsTo(Municipality::class, 'federal_states_id');
    }
}
