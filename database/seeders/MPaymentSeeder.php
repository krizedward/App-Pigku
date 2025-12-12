<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\MPayment;
use Illuminate\Support\Str;

class MPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MPayment::create([
            'type_payment' => 'online',
            'description_payment' => 'Transfer Bank',
            'note_payment' => '',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MPayment::create([
            'type_payment' => 'online',
            'description_payment' => 'Virtual Account (VA)',
            'note_payment' => '',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MPayment::create([
            'type_payment' => 'online',
            'description_payment' => 'E-Wallet',
            'note_payment' => '',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MPayment::create([
            'type_payment' => 'offline',
            'description_payment' => 'Tunai Cicil',
            'note_payment' => '',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        MPayment::create([
            'type_payment' => 'offline',
            'description_payment' => 'Tunai Lunas',
            'note_payment' => '',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
