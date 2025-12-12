<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class TRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('t_role')->insert([
            [
                'id'                   => 1,
                'role_id'              => 1,
                'pengguna_id'          => 1,
                'note_role'            => 1,
                'is_active'            => 'Y',
                'create_by'  => 'administrator',
                'update_by'  => 'administrator',
            ]
        ]);
    }
}
