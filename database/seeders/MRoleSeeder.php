<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class MRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('m_role')->insert([
            [
                'id'         => 1,
                'name_role'  => 'Super Admin',
                'note_role'  => 'Hak akses semua role',
                'is_active'  => 'Y',
                'create_by'  => 'administrator',
                'update_by'  => 'administrator',
                'created_at' => '2025-10-30 18:19:52',
                'updated_at' => '2025-10-30 19:18:35',
            ],
            [
                'id'         => 2,
                'name_role'  => 'Owner',
                'note_role'  => 'Hak akses bisnis owner',
                'is_active'  => 'Y',
                'create_by'  => 'administrator',
                'update_by'  => 'administrator',
                'created_at' => '2025-10-30 18:51:49',
                'updated_at' => '2025-10-30 19:19:04',
            ],
            [
                'id'         => 3,
                'name_role'  => 'Kasir',
                'note_role'  => 'Hak akses staff kasir',
                'is_active'  => 'Y',
                'create_by'  => 'administrator',
                'update_by'  => 'administrator',
                'created_at' => '2025-10-30 19:02:11',
                'updated_at' => '2025-10-30 19:18:09',
            ],
            [
                'id'         => 4,
                'name_role'  => 'Pelayan',
                'note_role'  => 'Hak akses staff pelayan',
                'is_active'  => 'Y',
                'create_by'  => 'administrator',
                'update_by'  => 'administrator',
                'created_at' => '2025-10-30 19:03:05',
                'updated_at' => '2025-10-30 19:17:39',
            ],
            [
                'id'         => 5,
                'name_role'  => 'Kitchen',
                'note_role'  => 'Hak akses staff dapur',
                'is_active'  => 'Y',
                'create_by'  => 'administrator',
                'update_by'  => 'administrator',
                'created_at' => '2025-10-30 19:08:01',
                'updated_at' => '2025-10-30 19:08:01',
            ],
            [
                'id'         => 6,
                'name_role'  => 'Customer',
                'note_role'  => 'Hak akses customer umum',
                'is_active'  => 'Y',
                'create_by'  => 'administrator',
                'update_by'  => 'administrator',
                'created_at' => '2025-10-30 19:13:44',
                'updated_at' => '2025-10-30 19:17:51',
            ],
            [
                'id'         => 7,
                'name_role'  => 'Member',
                'note_role'  => 'Hak akses customer member',
                'is_active'  => 'Y',
                'create_by'  => 'administrator',
                'update_by'  => 'administrator',
                'created_at' => '2025-10-30 19:14:38',
                'updated_at' => '2025-10-30 19:14:38',
            ],
            [
                'id'         => 8,
                'name_role'  => 'Inventory',
                'note_role'  => 'Hak akses staff gudang',
                'is_active'  => 'Y',
                'create_by'  => 'administrator',
                'update_by'  => 'administrator',
                'created_at' => '2025-10-30 19:15:45',
                'updated_at' => '2025-10-30 19:15:45',
            ],
            [
                'id'         => 9,
                'name_role'  => 'Akuntan',
                'note_role'  => 'Hak akses staff akuntan',
                'is_active'  => 'Y',
                'create_by'  => 'administrator',
                'update_by'  => 'administrator',
                'created_at' => '2025-10-30 19:17:11',
                'updated_at' => '2025-10-30 19:17:11',
            ],
        ]);
    }
}
