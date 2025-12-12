<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TExpense;

class TExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TExpense::create([
            'kategori_id' => '4',
            'payment_id' => '5',
            'date_expense' => '2025-09-01',
            'description_expense' => 'Lemak B2 (Max) @ 4 Kg',
            'total_price' => '300000',
            'note_expense' => '',
        ]);
        
        TExpense::create([
            'kategori_id' => '7',
            'payment_id' => '5',
            'date_expense' => '2025-09-01',
            'description_expense' => 'Box Plastik Besar @ 4 Pcs',
            'total_price' => '80000',
            'note_expense' => '',
        ]);

        TExpense::create([
            'kategori_id' => '4',
            'payment_id' => '5',
            'date_expense' => '2025-09-01',
            'description_expense' => 'Bawang Putih @ 3 Kg',
            'total_price' => '72000',
            'note_expense' => '',
        ]);

        TExpense::create([
            'kategori_id' => '6',
            'payment_id' => '5',
            'date_expense' => '2025-09-01',
            'description_expense' => 'Pegawai Harian @ Tante Eli',
            'total_price' => '70000',
            'note_expense' => '',
        ]);
    }
}