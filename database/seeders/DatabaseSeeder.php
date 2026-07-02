<?php
// database/seeders/AdminUserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AccUser;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // SUPER ADMIN
        AccUser::create([
            'nama' => 'Super Admin',
            'username' => 'superadmin',
            'phone' => '08123456789',
            'email' => 'superadmin@acc.com',
            'password' => Hash::make('super123'),
            'role' => 'superadmin',
        ]);

        // ADMIN KONTEN (mengelola artikel)
        AccUser::create([
            'nama' => 'Admin Konten',
            'username' => 'adminkonten',
            'phone' => '08123456780',
            'email' => 'konten@acc.com',
            'password' => Hash::make('konten123'),
            'role' => 'konten',
        ]);

        // ADMIN PENGGUNA (mengelola user)
        AccUser::create([
            'nama' => 'Admin Pengguna',
            'username' => 'adminpengguna',
            'phone' => '08123456781',
            'email' => 'pengguna@acc.com',
            'password' => Hash::make('pengguna123'),
            'role' => 'pengguna',
        ]);

        // ADMIN DIAGNOSIS (mengelola diagnosis)
        AccUser::create([
            'nama' => 'Admin Diagnosis',
            'username' => 'admindiagnosis',
            'phone' => '08123456782',
            'email' => 'diagnosis@acc.com',
            'password' => Hash::make('diagnosis123'),
            'role' => 'diagnosis',
        ]);

        // USER BIASA
        AccUser::create([
            'nama' => 'User Biasa',
            'username' => 'user',
            'phone' => '08123456783',
            'email' => 'user@acc.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);
    }
}