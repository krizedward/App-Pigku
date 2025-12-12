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
        Schema::create('t_pengguna', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('code_pengguna');
            $table->string('fullname_pengguna')->nullable();
            $table->string('username_pengguna')->nullable();
            $table->string('note_pengguna')->nullable();
            $table->enum('is_active', ['Y', 'N'])->default('Y')->nullable();
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->timestamps();
            
            // data utama pengguna
            // $table->string('nama_lengkap', 100);
            // $table->string('username', 50)->unique();
            // $table->string('email')->unique();
            // $table->string('password');
            // status dan verifikasi
            // $table->boolean('is_active')->default(true);
            // $table->timestamp('email_verified_at')->nullable();
            

            // kolom opsional (untuk t_pengguna_detail)
            // $table->string('no_hp', 20)->nullable();
            // $table->string('alamat')->nullable();
            // $table->string('foto_profil')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_pengguna');
    }
};
