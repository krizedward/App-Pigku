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
        Schema::create('t_debit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_debit');
            $table->string('description_debit')->nullable();
            $table->integer('amount_debit');
            $table->text('note_debit')->nullable();
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
        Schema::dropIfExists('t_debit');
    }
};
