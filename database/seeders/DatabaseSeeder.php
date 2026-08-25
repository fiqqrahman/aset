<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Utama Disdik Kota Palangka Raya
        User::updateOrCreate(
            ['email' => 'admin.disdik@palangkaraya.go.id'],
            [
                'nip'      => '198803122015031001',
                'name'     => 'Admin Dinas Pendidikan',
                'password' => Hash::make('password123'), // Ganti dengan password kuat antum nanti
            ]
        );
    }
}
