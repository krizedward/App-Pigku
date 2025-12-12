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
        Schema::create('t_menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('kategori_id')
                ->constrained('m_kategori')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('name_menu');
            $table->integer('price_menu');
            $table->text('note_menu')->nullable();
            $table->enum('is_active', ['Y', 'N'])->default('Y')->nullable();
            // - harga_menu
            // - stok_menu
            // - note_menu
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
        Schema::dropIfExists('t_menu');
    }
};
