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
        Schema::create('t_sale', function (Blueprint $table) {
            $table->id();
            $table->string('name_menu')->nullable();
            $table->integer('price_menu')->nullable();
            $table->date('date_order');                 // tanggal order
            $table->integer('qty_order');               // jumlah pesanan
            $table->integer('total_price');             // total harga menu
            $table->text('note_sale')->nullable();     // catatan
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_sale');
    }
};
