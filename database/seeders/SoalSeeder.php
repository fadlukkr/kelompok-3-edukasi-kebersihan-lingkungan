<?php

namespace Database\Seeders;

use App\Models\Soal;
use Illuminate\Database\Seeder;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $soals = [
            [
                'pertanyaan' => 'Manakah dari berikut ini yang termasuk ke dalam sampah organik?',
                'opsi_a' => 'Botol kaca',
                'opsi_b' => 'Sisa sayuran dan buah',
                'opsi_c' => 'Kaleng minuman',
                'opsi_d' => 'Kantong plastik sekali pakai',
                'jawaban_benar' => 'B',
            ],
            [
                'pertanyaan' => 'Apa arti dari prinsip "Reduce" dalam gerakan 3R?',
                'opsi_a' => 'Mendaur ulang sampah menjadi produk baru',
                'opsi_b' => 'Menggunakan kembali barang bekas',
                'opsi_c' => 'Mengurangi penggunaan bahan yang berpotensi menjadi sampah',
                'opsi_d' => 'Membakar sampah di tempat pembuangan akhir',
                'jawaban_benar' => 'C',
            ],
            [
                'pertanyaan' => 'Mengapa septic tank harus berjarak minimal 10 meter dari sumber air bersih?',
                'opsi_a' => 'Agar mudah dikuras',
                'opsi_b' => 'Agar air sumur tidak bau septic tank',
                'opsi_c' => 'Mencegah kontaminasi bakteri patogen ke sumber air bersih',
                'opsi_d' => 'Meningkatkan estetika halaman rumah',
                'jawaban_benar' => 'C',
            ],
            [
                'pertanyaan' => 'Bahan manakah yang membutuhkan waktu paling lama untuk terurai secara alami?',
                'opsi_a' => 'Kertas koran',
                'opsi_b' => 'Kulit pisang',
                'opsi_c' => 'Plastik sekali pakai',
                'opsi_d' => 'Ranting pohon',
                'jawaban_benar' => 'C',
            ],
        ];

        foreach ($soals as $soal) {
            Soal::firstOrCreate(
                ['pertanyaan' => $soal['pertanyaan']],
                $soal
            );
        }
    }
}
