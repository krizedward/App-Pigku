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
        Schema::create('t_sale_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')
                ->constrained('t_sale')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('menu_id')
                ->constrained('t_menu')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('qty_detailsale'); 
            $table->decimal('price_detailsale', 15, 2);
            $table->decimal('subtotal_detailsale', 15, 2);
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
        Schema::dropIfExists('t_sale_detail');
    }
};
