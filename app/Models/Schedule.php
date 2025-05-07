<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
  use HasFactory;

    protected $table = 'schedules';

        public function headquarters()
    {
        return $this->belongsTo(Headquarter::class);
    }
        public function unit()
    {
        return $this->belongsTo(OrganizationalUnit::class);
    }
        public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function scheduleDetails()
    {
        return $this->hasMany(ScheduleDetail::class);
    }




}
