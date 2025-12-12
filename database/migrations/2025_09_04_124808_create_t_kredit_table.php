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
        Schema::create('t_kredit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date_kredit');
            $table->string('description_kredit')->nullable();
            $table->integer('amount_kredit');
            $table->text('note_kredit')->nullable();
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
        Schema::dropIfExists('t_kredit');
    }
};
