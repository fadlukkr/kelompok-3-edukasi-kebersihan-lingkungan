<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('soal', function (Blueprint $table) {
            $table->id('id_soal');
            $table->foreignId('id_admin')->nullable()->constrained('admin', 'id_admin')->nullOnDelete();
            $table->text('pertanyaan');
            $table->string('opsi_a');
            $table->string('opsi_b');
            $table->string('opsi_c');
            $table->string('opsi_d');
            $table->enum('jawaban_benar', ['A', 'B', 'C', 'D']);
            $table->timestamps();
        });

        Schema::create('jawaban', function (Blueprint $table) {
            $table->id('id_jawaban');
            $table->foreignId('id_masyarakat')->constrained('masyarakat', 'id_masyarakat')->cascadeOnDelete();
            $table->unsignedTinyInteger('skor');
            $table->enum('status_kelulusan', ['Lulus', 'Gagal']);
            $table->timestamps();
        });

        Schema::create('laporan', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->foreignId('id_masyarakat')->constrained('masyarakat', 'id_masyarakat')->cascadeOnDelete();
            $table->foreignId('id_admin')->nullable()->constrained('admin', 'id_admin')->nullOnDelete();
            $table->string('judul_laporan', 150);
            $table->string('nama_pelapor', 100);
            $table->string('lokasi', 255);
            $table->enum('kategori', ['Sampah Liar', 'Saluran Tersumbat', 'Pencemaran Air', 'Lainnya']);
            $table->text('deskripsi');
            $table->string('bukti')->nullable();
            $table->enum('status_verifikasi', ['menunggu', 'terverifikasi', 'ditolak'])->default('menunggu');
            $table->timestamps();
        });

        Schema::create('feedback', function (Blueprint $table) {
            $table->id('id_feedback');
            $table->foreignId('id_masyarakat')->constrained('masyarakat', 'id_masyarakat')->cascadeOnDelete();
            $table->string('nama', 100);
            $table->text('pesan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedback');
        Schema::dropIfExists('laporan');
        Schema::dropIfExists('jawaban');
        Schema::dropIfExists('soal');
    }
};
