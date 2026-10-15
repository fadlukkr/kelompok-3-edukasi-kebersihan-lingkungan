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
        Schema::create('edukasi', function (Blueprint $table) {
            $table->id('id_edukasi'); // Primary key edukasi
            $table->string('judul_edukasi');
            $table->longText('isi_materi'); // Tipe data LONGTEXT sesuai permintaan
            $table->timestamp('tanggal_upload')->useCurrent(); // Otomatis isi tanggal saat ini

            // Foreign Key yang disesuaikan dengan tabel 'admin'
            $table->unsignedBigInteger('id_admin');
            $table->foreign('id_admin')
                ->references('id_admin')
                ->on('admin')           // ⚠️ Menyesuaikan nama tabel 'admin' (tanpa 's')
                ->onDelete('cascade');

            $table->timestamps(); // created_at dan updated_at standar Laravel
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edukasi');
    }
};
