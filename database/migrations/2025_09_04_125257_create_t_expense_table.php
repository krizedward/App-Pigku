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
        Schema::create('t_expense', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('kategori_id')
                ->constrained('m_kategori')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('payment_id')
                ->constrained('m_payment')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('description_expense')->nullable();
            $table->date('date_expense');                       // tanggal order
            $table->integer('total_price');                     // total harga menu
            $table->text('note_expense')->nullable();           // catatan
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
        Schema::dropIfExists('t_expense');
    }
};
