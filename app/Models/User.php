<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'users';

    protected $hidden = ['password'];
    public function role()  
    {  
        return $this->belongsTo(Role::class);  
    } 
    public function allocations()
    {
        return $this->hasMany(Allocation::class, 'emp_code');
    }
}
