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
        Schema::create('t_role', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('role_id')
                ->constrained('m_role')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            
            $table->foreignId('pengguna_id')
                ->constrained('t_pengguna')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            
            $table->string('note_role')->nullable();
            $table->enum('is_active', ['Y', 'N'])->default('Y')->nullable();
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
        Schema::dropIfExists('t_role');
    }
};
