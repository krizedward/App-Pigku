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
        Schema::create('t_temporder', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_id');
            $table->date('date_order');
            $table->string('name_menu');
            $table->integer('price_menu');
            $table->integer('qty_menu');
            $table->integer('subtotal_price');  
            $table->timestamps();

            $table->foreign('menu_id')
            ->references('id')
            ->on('t_menu')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_temporder');
    }
};
