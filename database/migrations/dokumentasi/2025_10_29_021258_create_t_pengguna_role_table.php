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
        Schema::create('t_pengguna_role', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')
                ->constrained('t_pengguna')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->enum('account_role', ['Y', 'N']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pengguna_role');
    }
};
