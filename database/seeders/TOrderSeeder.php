<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TOrder;

class TOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TOrder::create([
            'menu_id' => '1',
            'date_order' => '2025-09-02',
            'qty_order' => '18',
            'total_price' => '630000',
            'note_order' => '',
        ]);

        TOrder::create([
            'menu_id' => '15',
            'date_order' => '2025-09-02',
            'qty_order' => '2',
            'total_price' => '10000',
            'note_order' => '',
        ]);

        TOrder::create([
            'menu_id' => '18',
            'date_order' => '2025-09-02',
            'qty_order' => '3',
            'total_price' => '15000',
            'note_order' => '',
        ]);

        TOrder::create([
            'menu_id' => '19',
            'date_order' => '2025-09-02',
            'qty_order' => '1',
            'total_price' => '5000',
            'note_order' => '',
        ]);

        TOrder::create([
            'menu_id' => '2',
            'date_order' => '2025-09-02',
            'qty_order' => '3',
            'total_price' => '15000',
            'note_order' => '',
        ]);
    }
}