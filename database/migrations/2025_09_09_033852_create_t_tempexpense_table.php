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
        Schema::create('t_tempexpense', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('kategori_id')
                ->constrained('m_kategori')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('payment_id')
                ->constrained('m_payment')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('description_expense');
            $table->date('date_expense');
            $table->integer('total_price');
            $table->text('note_expense')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_tempexpense');
    }
};
