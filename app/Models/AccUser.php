<?php
// app/Models/AccUser.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AccUser extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'acc_users';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (self::max('id') ?? 0) + 1;
            }
        });
    }
    
    protected $fillable = [
        'nama',
        'username',
        'phone',
        'email',
        'password',
        'role',
        'is_active', // TAMBAHKAN INI
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // ========== ROLE CHECK METHODS ==========
    
    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    public function isAdminKonten(): bool
    {
        return $this->role === 'konten';
    }

    public function isAdminPengguna(): bool
    {
        return $this->role === 'pengguna';
    }

    public function isAdminDiagnosis(): bool
    {
        return $this->role === 'diagnosis';
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, ['superadmin', 'konten', 'pengguna', 'diagnosis']);
    }

    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function hasilDiagnosis()
    {
        return $this->hasMany(HasilDiagnosis::class, 'acc_user_id');
    }
// Relasi ke Kabar Sekitar
public function kabarSekitar()
{
    return $this->hasMany(KabarSekitar::class, 'user_id');
}

// Relasi ke Riwayat Prediksi
public function riwayatPrediksi()
{
    return $this->hasMany(RiwayatPrediksi::class, 'user_id');
}
}