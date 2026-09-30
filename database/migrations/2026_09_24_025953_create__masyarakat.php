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
            Schema::create('masyarakat', function (Blueprint $table) {
        $table->id('id_masyarakat');
        $table->string('nama_lengkap', 100)
            ->comment('Nama lengkap pengguna');
        $table->string('email', 100)
            ->unique()
            ->comment('Email untuk login (unik)');
        $table->string('password_hash', 255)
            ->comment('Hash password (bcrypt/argon2)');
        $table->enum('status', ['aktif', 'tidak aktif'])
            ->default('aktif')
            ->comment('Status akun: aktif dapat login, tidak aktif diblokir');
        $table->string('alamat', 100)
            ->nullable()
            ->comment('Alamat profil pengguna');

        $table->index('status', 'idx_masyarakat_status');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_masyarakat');
    }
};
