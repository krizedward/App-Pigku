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
        Schema::create('t_order_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->constrained('t_order')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('name_menu')->nullable();
            $table->integer('qty_order'); 
            $table->integer('price_menu')->nullable();
            $table->string('unit_menu')->nullable();
            $table->text('note_order_detail')->nullable();
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
        Schema::dropIfExists('t_order_detail');
    }
};
