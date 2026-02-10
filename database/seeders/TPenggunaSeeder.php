<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TPengguna;
use App\Models\User;

class TPenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ADMIN
        $admin = User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('12345678'),
            ]
        );

        TPengguna::firstOrCreate(
            ['user_id' => $admin->id],
            [
                'code_pengguna' => 'PGN-ADMIN-001',
                'fullname_pengguna' => 'Administrator System',
                'username_pengguna' => 'admin',
                'note_pengguna' => 'Akun default',
                'is_active' => 'Y',
                'create_by' => 'system',
            ]
        );

        // OWNER
        $owner = User::firstOrCreate(
            ['email' => 'renaltmangare15@gmail.com'],
            [
                'name' => 'owner.renalt',
                'password' => bcrypt('12345678'),
            ]
        );

        TPengguna::firstOrCreate(
            ['user_id' => $owner->id],
            [
                'code_pengguna' => 'PGN-OWNER-001',
                'fullname_pengguna' => 'Renalt Mangare',
                'username_pengguna' => 'owner',
                'note_pengguna' => 'Pemilik restoran',
                'is_active' => 'Y',
                'create_by' => 'system',
            ]
        );
    }
}
