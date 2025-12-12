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
        Schema::create('m_payment', function (Blueprint $table) {
            $table->id();
            $table->enum('type_payment', ['online', 'offline']); // payment channel type
            $table->string('description_payment'); // Transfer Bank, COD / Cash On Delivery, Bayar Langsung di Lokasi
            $table->text('note_payment')->nullable(); // catatan
            $table->enum('is_active', ['Y', 'N'])->default('Y')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_payment');
    }
};
