<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('t_tempmenudetail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')
                ->constrained('t_menu_paket') // paket juga ada di t_menu
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('menu_id')
                ->constrained('t_menu') // item yang masuk ke paket
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('qty_menu'); // jumlah item dalam paket
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_tempmenudetail');
    }
};
