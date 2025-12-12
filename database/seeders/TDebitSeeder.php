<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TDebit;

class TDebitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TDebit::create([
            'date_debit' => '2025-09-02',
            'description_debit' => 'Total Penjualan 02 September 2025',
            'amount_debit' => '675000',
            'note_debit' => 'Auto-generated from order',
        ]);
    }
}
