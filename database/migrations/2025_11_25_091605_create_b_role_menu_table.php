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
        Schema::create('b_role_menu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trole_id')
                ->constrained('t_role')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('bmenu_id')
                ->constrained('b_menu')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->text('note_b_role_menu')->nullable();
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
        Schema::dropIfExists('b_role_menu');
    }
};
