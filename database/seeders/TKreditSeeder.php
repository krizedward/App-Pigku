<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\TKredit;

class TKreditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        TKredit::create([
            'date_kredit' => '2025-09-01',
            'description_kredit' => 'Total Pengeluaran 01 September 2025',
            'amount_kredit' => '522000',
            'note_kredit' => 'Auto-generated from expense',
        ]);
    }
}
