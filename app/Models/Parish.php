<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parish extends Model
{
 protected $fillable = [
    'id',
    'municipality_id',
    'name'];
}
