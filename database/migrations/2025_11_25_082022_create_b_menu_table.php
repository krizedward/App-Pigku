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
        Schema::create('b_menu', function (Blueprint $table) {
            $table->id();
            $table->string('menu_code')->nullable();
            $table->string('menu_category_code')->nullable();
            $table->string('menu_name')->nullable();
            $table->string('menu_host')->nullable();
            $table->string('update_url')->nullable();
            $table->string('menu_order')->nullable(); 
            $table->string('menu_type')->nullable();
            $table->enum('is_active', ['Y', 'N'])->default('Y')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b_menu');
    }
};
