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
        Schema::create('t_income', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('kategori_id')
                ->constrained('m_kategori')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('description_income')->nullable();
            $table->date('date_income');                       // tanggal order
            $table->integer('total_price');                     // total harga menu
            $table->text('note_income')->nullable(); 
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
        Schema::dropIfExists('t_income');
    }
};
