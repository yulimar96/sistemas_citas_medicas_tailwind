<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Patient;
use App\Models\Persons;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    
     protected $fillable = [
        'name', 'email', 'password', 'role', 'status'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
      public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
     public function person()
    {
        return $this->belongsTo(Persons::class, 'user_id'); // Cambia 'user_id' si es necesario
    }

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }

    public function patient()
    {
        return $this->hasMany(Patient::class);
    }
        public function event()
    {
        return $this->hasMany(Event::class);
    }
        public function getIsAdminAttribute()
    {
        // Supongamos que tienes un campo 'role' en tu tabla 'users'
        return $this->role === 'admin'; // Cambia 'role' y 'admin' según tu lógica
    }

}
//     public function create()
// {
//     $roles = Role::all();
//     return view('user.create', compact('roles'));
// }
 // Método para verificar si el usuario es admin


