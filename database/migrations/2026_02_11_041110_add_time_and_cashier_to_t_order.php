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
        Schema::table('t_order', function (Blueprint $table) {
            //
            $table->time('time_order')->after('date_order');
            $table->string('cashier_name')->nullable()->after('note_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('t_order', function (Blueprint $table) {
            //
        });
    }
};
