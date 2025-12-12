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
        Schema::create('t_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('menu_id')
                ->constrained('t_menu')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->date('date_order');                 // tanggal order
            $table->integer('qty_order');               // jumlah pesanan
            $table->integer('total_price');             // total harga menu
            $table->text('note_order')->nullable();     // catatan
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->timestamps();                       // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_order');
    }
};
