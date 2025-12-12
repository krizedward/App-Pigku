<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TMenuPaket;

class TMenuPaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TMenuPaket::create([
            'menu_id'   => 5, // paket sate
        ]);

        TMenuPaket::create([
            'menu_id'   => 6, // paket sate
        ]);

        TMenuPaket::create([
            'menu_id'   => 7, // paket sate
        ]);

        TMenuPaket::create([
            'menu_id'   => 8, // paket sate
        ]);

        TMenuPaket::create([
            'menu_id'   => 9, // paket sate
        ]);

        TMenuPaket::create([
            'menu_id'   => 10, // paket sate
        ]);
    }
}
