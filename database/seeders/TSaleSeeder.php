<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TOrder;
use App\Models\TSale;

class TSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $dataOrders = TOrder::all();

        foreach ($dataOrders as $order) {
            TSale::create([
                'name_menu'   => $order->t_menu->name_menu,
                'price_menu'  => $order->t_menu->price_menu,
                'date_order'  => $order->date_order,
                'qty_order'   => $order->qty_order,
                'total_price' => $order->total_price,
                'note_sale'   => $order->note_order ?? null,
                'create_by'   => $order->create_by,
                'update_by'   => $order->update_by,
            ]);
        }
    }
}
