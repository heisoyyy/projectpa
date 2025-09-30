<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // // contoh user role:user
        // User::create([
        //     'email' => '1@gmail.com',
        //     'password' => Hash::make('123321'),
        //     'nama_sekolah' => 'SMA Negeri 1 Pekanbaru A',
        //     'nomor_sekolah' => '123456789',
        //     'kota' => 'Pekanbaru',
        //     'role' => 'user',
        //     'status' => 'pending',
        // ]);
        
        // // contoh user role:user
        // User::create([
        //     'email' => '2@gmail.com',
        //     'password' => Hash::make('123321'),
        //     'nama_sekolah' => 'SMA Negeri 1 Pekanbaru B',
        //     'nomor_sekolah' => '123456788',
        //     'kota' => 'Pekanbaru',
        //     'role' => 'user',
        //     'status' => 'pending',
        // ]);

        // contoh user role:admin
        User::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123'),
            'nama_sekolah' => 'Admin Sekolah',
            'nomor_sekolah' => '87654321',
            'kota' => 'Pekanbaru',
            'role' => 'admin',
        ]);
    }
}
