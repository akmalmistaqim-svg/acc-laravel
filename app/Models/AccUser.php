<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AccUser extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'acc_users';
    
    protected $fillable = [
        'nama',
        'username',
        'phone',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}