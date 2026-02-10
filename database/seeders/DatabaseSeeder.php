<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BMenuSeeder::class,
            MRoleSeeder::class,
            MPaymentSeeder::class,
            MKategoriSeeder::class,
            TMenuSeeder::class,
            TDebitSeeder::class,
            TKreditSeeder::class,
            TExpenseSeeder::class,
            // TOrderSeeder::class,
            TMenuPaketSeeder::class,
            TMenuDetailSeeder::class,
            TPenggunaSeeder::class,
            TRoleSeeder::class,
            BRoleMenuSeeder::class,
            // TSaleSeeder::class,
            // TOrderOldSeeder::class,
        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
