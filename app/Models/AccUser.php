<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccUser extends Model
{
    protected $table = 'acc_users';
    
    protected $fillable = [
        'nama',
        'username',
        'phone',
        'email',
        'password',
    ];
}