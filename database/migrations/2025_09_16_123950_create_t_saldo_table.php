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
        Schema::create('t_saldo', function (Blueprint $table) {
            $table->id();
            $table->date('start_date'); // contoh: 2025-09-01
            $table->date('end_date'); // contoh: 2025-09-01
            $table->integer('starting_saldo');
            $table->integer('income_saldo');
            $table->integer('expense_saldo');
            $table->integer('ending_saldo');
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->timestamps();

            //transaksi
            // $table->id();
            // $table->unsignedBigInteger('user_id');
            // $table->enum('type', ['debit', 'credit']);   // debit = keluar, credit = masuk
            // $table->enum('category', ['income', 'expense']); // pendapatan / pengeluaran
            // $table->decimal('amount', 15, 2);
            // $table->string('description')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_saldo');
    }
};
