<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Andi',
            'email' => 'admin@manajemen.com',
            'jabatan' => 'Admin',
            'password' => Hash::make('123123123'),
            'is_tugas' => false,
        ]);

        User::create([
            'name' => 'Anfa ',
            'email' => 'anfa@manajemen.com',
            'jabatan' => 'Karyawan',
            'password' => Hash::make('123123123'),
            'is_tugas' => false,
        ]);

        User::create([
            'name' => 'Tini',
            'email' => 'Tini@manajemen.com',
            'jabatan' => 'Karyawan',
            'password' => Hash::make('123123123'),
            'is_tugas' => false,
        ]);

        User::create([
            'name' => 'Nanda',
            'email' => 'nanda@manajemen.com',
            'jabatan' => 'Karyawan',
            'password' => Hash::make('123123123'),
            'is_tugas' => false,
        ]);
    }
}
