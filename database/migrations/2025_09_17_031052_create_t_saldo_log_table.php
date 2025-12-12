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
        Schema::create('t_saldo_log', function (Blueprint $table) {
            $table->id();
            $table->foreignId('saldo_id')
                ->constrained('t_saldo')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer('change_amount');
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
        Schema::dropIfExists('t_saldo_log');
    }
};
