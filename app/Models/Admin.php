<?php
// app/Models/Admin.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'nama', 'username', 'password', 'role', 'is_active'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    public function isKonten(): bool
    {
        return $this->role === 'konten';
    }

    public function isPengguna(): bool
    {
        return $this->role === 'pengguna';
    }

    public function hasAccess(string $role): bool
    {
        if ($this->isSuperAdmin()) return true;
        return $this->role === $role;
    }
}