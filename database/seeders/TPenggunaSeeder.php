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
        //
        // Make sure there’s at least one user in the users table
        $user = User::first() ?? User::factory()->create([
            'name' => 'administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('12345678'),
        ]);

        // Create some sample TPengguna records
        TPengguna::create([
            'user_id' => $user->id,
            'code_pengguna' => 'PGN-202510280983',
            'fullname_pengguna' => 'Edward Kristian Mangare',
            'username_pengguna' => 'edwardisme',
            'note_pengguna' => 'Tidak ada',
            'is_active' => 'Y',
            'create_by' => 'administrator',
        ]);
    }
}
