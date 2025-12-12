<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TMenuDetail;

class TMenuDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TMenuDetail::create([
            'paket_id'  => 1, // paket ala carte campur
            'menu_id'   => 4, // sate campur
            'qty_menu'  => 8, // jumlah
        ]);

        TMenuDetail::create([
            'paket_id'  => 1, // paket ala carte campur
            'menu_id'   => 20, // sambel
            'qty_menu'  => 1, // jumlah
        ]);

        TMenuDetail::create([
            'paket_id'  => 2, // paket ala carte daging
            'menu_id'   => 3, // sate daging
            'qty_menu'  => 8, // jumlah
        ]);

        TMenuDetail::create([
            'paket_id'  => 2, // paket ala carte daging
            'menu_id'   => 20, // sambel
            'qty_menu'  => 1, // jumlah
        ]);

        // paket reguler campur (3 item)
        TMenuDetail::create([
            'paket_id'  => 3, // paket reguler campur
            'menu_id'   => 4, // sate campur
            'qty_menu'  => 8, // jumlah
        ]);

        TMenuDetail::create([
            'paket_id'  => 3, // paket reguler campur
            'menu_id'   => 19, // lontong
            'qty_menu'  => 1, // jumlah
        ]);

        TMenuDetail::create([
            'paket_id'  => 3, // paket reguler campur
            'menu_id'   => 20, // sambel
            'qty_menu'  => 1, // jumlah
        ]);

        // paket reguler daging (3 item)
        TMenuDetail::create([
            'paket_id'  => 4, // paket reguler daging
            'menu_id'   => 3, // sate daging
            'qty_menu'  => 8, // jumlah
        ]);

        TMenuDetail::create([
            'paket_id'  => 4, // paket reguler daging
            'menu_id'   => 19, // lontong
            'qty_menu'  => 1, // jumlah
        ]);

        TMenuDetail::create([
            'paket_id'  => 4, // paket reguler daging
            'menu_id'   => 20, // sambel
            'qty_menu'  => 1, // jumlah
        ]);

        // paket guik campur (2 item)
        TMenuDetail::create([
            'paket_id'  => 5, // paket guik campur
            'menu_id'   => 7, // paket reguler campur
            'qty_menu'  => 1, // jumlah
        ]);

        TMenuDetail::create([
            'paket_id'  => 5, // paket guik campur
            'menu_id'   => 2, // teh
            'qty_menu'  => 1, // jumlah
        ]);

        // paket guik daging (2 item)
        TMenuDetail::create([
            'paket_id'  => 6, // paket guik daging
            'menu_id'   => 8, // paket reguler daging
            'qty_menu'  => 1, // jumlah
        ]);

        TMenuDetail::create([
            'paket_id'  => 6, // paket guik daging
            'menu_id'   => 2, // teh
            'qty_menu'  => 1, // jumlah
        ]);
    }
}
