<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\BMenu;

class BMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('b_menu')->insert([
            [
                'id'                   => 1,
                'menu_code'            => 'assessment-form',
                'menu_category_code'   => 'hrd',
                'menu_name'            => 'Form Penilaian',
                'menu_host'            => '192.168.97.120:8000',
                'update_url'           => 'student_yearly',
                'menu_order'           => '1',
                'menu_type'            => 'paging',
                'is_active'            => 'N',
            ],
            [
                'id'                   => 2,
                'menu_code'            => 'master-kategori',
                'menu_category_code'   => 'master',
                'menu_name'            => 'Master Kategori',
                'menu_host'            => null,
                'update_url'           => null,
                'menu_order'           => '1',
                'menu_type'            => 'paging',
                'is_active'            => 'Y',
            ],
            [
                'id'                   => 3,
                'menu_code'            => 'master-payment',
                'menu_category_code'   => 'master',
                'menu_name'            => 'Master Payment',
                'menu_host'            => null,
                'update_url'           => null,
                'menu_order'           => '2',
                'menu_type'            => 'paging',
                'is_active'            => 'Y',
            ],
            [
                'id'                   => 4,
                'menu_code'            => 'master-role',
                'menu_category_code'   => 'master',
                'menu_name'            => 'Master Role',
                'menu_host'            => null,
                'update_url'           => null,
                'menu_order'           => '3',
                'menu_type'            => 'paging',
                'is_active'            => 'Y',
            ],
            [
                'id'                   => 5,
                'menu_code'            => 'menu',
                'menu_category_code'   => 'menu',
                'menu_name'            => 'Menu',
                'menu_host'            => null,
                'update_url'           => null,
                'menu_order'           => '1',
                'menu_type'            => 'paging',
                'is_active'            => 'Y',
            ],
            [
                'id'                   => 6,
                'menu_code'            => 'order',
                'menu_category_code'   => 'sales',
                'menu_name'            => 'Order',
                'menu_host'            => null,
                'update_url'           => null,
                'menu_order'           => '1',
                'menu_type'            => 'paging',
                'is_active'            => 'Y',
            ],
            [
                'id'                   => 7,
                'menu_code'            => 'pengeluaran',
                'menu_category_code'   => 'sales',
                'menu_name'            => 'Pengeluaran',
                'menu_host'            => null,
                'update_url'           => null,
                'menu_order'           => '2',
                'menu_type'            => 'paging',
                'is_active'            => 'Y',
            ],
            [
                'id'                   => 8,
                'menu_code'            => 'pengguna',
                'menu_category_code'   => 'user',
                'menu_name'            => 'Pengguna',
                'menu_host'            => null,
                'update_url'           => null,
                'menu_order'           => '1',
                'menu_type'            => 'paging',
                'is_active'            => 'Y',
            ],
            [
                'id'                   => 9,
                'menu_code'            => 'akses',
                'menu_category_code'   => 'user',
                'menu_name'            => 'Akses',
                'menu_host'            => null,
                'update_url'           => null,
                'menu_order'           => '2',
                'menu_type'            => 'paging',
                'is_active'            => 'Y',
            ],
            [
                'id'                   => 10,
                'menu_code'            => 'kasir',
                'menu_category_code'   => 'sales',
                'menu_name'            => 'Kasir',
                'menu_host'            => null,
                'update_url'           => null,
                'menu_order'           => '2',
                'menu_type'            => 'paging',
                'is_active'            => 'Y',
            ],
            [
                'id'                   => 11,
                'menu_code'            => 'nota',
                'menu_category_code'   => 'sales',
                'menu_name'            => 'Nota',
                'menu_host'            => null,
                'update_url'           => null,
                'menu_order'           => '2',
                'menu_type'            => 'paging',
                'is_active'            => 'Y',
            ],
            [
                'id'                   => 12,
                'menu_code'            => 'master-satuan',
                'menu_category_code'   => 'master',
                'menu_name'            => 'Master Satuan',
                'menu_host'            => null,
                'update_url'           => null,
                'menu_order'           => '4',
                'menu_type'            => 'paging',
                'is_active'            => 'Y',
            ],
            [
                'id'                   => 13,
                'menu_code'            => 'master-barang',
                'menu_category_code'   => 'master',
                'menu_name'            => 'Master Barang',
                'menu_host'            => null,
                'update_url'           => null,
                'menu_order'           => '5',
                'menu_type'            => 'paging',
                'is_active'            => 'Y',
            ],
        ]);
    }
}
