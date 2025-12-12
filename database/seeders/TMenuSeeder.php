<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TMenu;

class TMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TMenu::create([
            'kategori_id' => '1',
            'name_menu' => 'Sate B2 Perporsi',
            'price_menu' => '35000',
            'note_menu' => '',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '2',
            'name_menu' => 'Teh (Es/Hangat)',
            'price_menu' => '5000',
            'note_menu' => '',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '1',
            'name_menu' => 'Sate B2 Daging Per Tusuk',
            'price_menu' => '5000',
            'note_menu' => '1 Tusuk',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '1',
            'name_menu' => 'Sate B2 Campur Per Tusuk',
            'price_menu' => '4500',
            'note_menu' => '1 Tusuk',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '1',
            'name_menu' => 'Ala Carte Campur',
            'price_menu' => '35000',
            'note_menu' => '8 Tusuk + Sambel',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '1',
            'name_menu' => 'Ala Carte Daging',
            'price_menu' => '40000',
            'note_menu' => '8 Tusuk + Sambel',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '1',
            'name_menu' => 'Paket Reguler Campur',
            'price_menu' => '35000',
            'note_menu' => '8 Tusuk + Lontong + Sambel',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '1',
            'name_menu' => 'Paket Reguler Daging',
            'price_menu' => '40000',
            'note_menu' => '8 Tusuk + Lontong + Sambel',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '1',
            'name_menu' => 'Paket Guik Campur',
            'price_menu' => '39000',
            'note_menu' => 'Paket Reguler Campur + Es Teh',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '1',
            'name_menu' => 'Paket Guik Daging',
            'price_menu' => '44000',
            'note_menu' => 'Paket Reguler Daging + Es Teh',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '2',
            'name_menu' => 'Es Teh Manis',
            'price_menu' => '5000',
            'note_menu' => '',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '2',
            'name_menu' => 'Es Teh Tawar',
            'price_menu' => '5000',
            'note_menu' => '',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '2',
            'name_menu' => 'Teh Hangat Manis',
            'price_menu' => '5000',
            'note_menu' => '',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '2',
            'name_menu' => 'Teh Hangat Tawar',
            'price_menu' => '5000',
            'note_menu' => '',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '2',
            'name_menu' => 'Air Mineral',
            'price_menu' => '5000',
            'note_menu' => '',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '2',
            'name_menu' => 'Kopi Hitam Pahit',
            'price_menu' => '5000',
            'note_menu' => '',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '2',
            'name_menu' => 'Kopi Hitam Manis',
            'price_menu' => '5000',
            'note_menu' => '',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '3',
            'name_menu' => 'Nasi Putih',
            'price_menu' => '5000',
            'note_menu' => '',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '3',
            'name_menu' => 'Lontong',
            'price_menu' => '5000',
            'note_menu' => '',
            'is_active' => true,
        ]);

        TMenu::create([
            'kategori_id' => '3',
            'name_menu' => 'Sambel',
            'price_menu' => '3000',
            'note_menu' => '',
            'is_active' => true,
        ]);
    }
}
