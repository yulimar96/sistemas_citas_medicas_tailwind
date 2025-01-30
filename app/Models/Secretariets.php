<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secretariets extends Model
{
    protected $fillable = [
        'name',
        'email',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
