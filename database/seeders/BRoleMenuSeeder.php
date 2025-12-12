<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\BRoleMenu;

class BRoleMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        BRoleMenu::create([
            'trole_id' => 1,
            'bmenu_id' => 1,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        BRoleMenu::create([
            'trole_id' => 1,
            'bmenu_id' => 2,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        BRoleMenu::create([
            'trole_id' => 1,
            'bmenu_id' => 3,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        BRoleMenu::create([
            'trole_id' => 1,
            'bmenu_id' => 4,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        BRoleMenu::create([
            'trole_id' => 1,
            'bmenu_id' => 5,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        BRoleMenu::create([
            'trole_id' => 1,
            'bmenu_id' => 6,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        BRoleMenu::create([
            'trole_id' => 1,
            'bmenu_id' => 7,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        BRoleMenu::create([
            'trole_id' => 1,
            'bmenu_id' => 8,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        BRoleMenu::create([
            'trole_id' => 1,
            'bmenu_id' => 9,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
