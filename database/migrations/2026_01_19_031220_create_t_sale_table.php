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
            $table->foreignId('order_id')
                ->constrained('t_order')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            
            $table->foreignId('payment_id')
                ->constrained('m_payment')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            
            // nilai transaksi
            $table->integer('subtotal_sale');
            $table->integer('tax_sale')->default(0);
            $table->integer('discount_sale')->default(0);
            $table->integer('total_sale');

            // pembayaran
            $table->integer('paid_sale');
            $table->integer('change_sale')->default(0);
            $table->text('status_sale')->nullable();

            $table->text('note_sale')->nullable();
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->timestamps();

            // $table->decimal('subtotal_sale', 15, 2);
            // $table->decimal('tax_sale', 15, 2)->default(0);
            // $table->decimal('discount_sale', 15, 2)->default(0);
            // $table->decimal('amount_sale', 15, 2);
            // $table->text('note_sale')->nullable();
            // $table->string('create_by')->nullable();
            // $table->string('update_by')->nullable();
            // $table->timestamps(); 
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
