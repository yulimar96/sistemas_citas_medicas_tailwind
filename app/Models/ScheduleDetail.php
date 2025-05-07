<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 


class ScheduleDetail extends Model
{
   use HasFactory;

    protected $table = 'schedule_details';

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

}
