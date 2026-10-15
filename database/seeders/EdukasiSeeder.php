<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Edukasi;
use Illuminate\Database\Seeder;

class EdukasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::first();
        $adminId = $admin ? $admin->id_admin : 1;

        $materi = [
            [
                'judul_edukasi' => 'Jenis Sampah Organik & Anorganik',
                'isi_materi' => "Sampah Organik adalah sampah yang berasal dari sisa makhluk hidup yang mudah membusuk secara alami tanpa proses campur tangan manusia untuk dapat terurai. Contohnya: sisa makanan, daun kering, sayuran, dan buah-buahan. Sampah ini bisa diolah menjadi pupuk kompos.\n\nSampah Anorganik adalah sampah yang dihasilkan dari bahan-bahan non-hayati, baik berupa produk sintetik maupun hasil proses teknologi pengolahan bahan tambang. Contohnya: botol plastik, kantong plastik, kaleng, kaca, dan kertas. Sampah ini membutuhkan waktu ratusan tahun untuk terurai secara alami, sehingga daur ulang adalah solusi terbaik.",
                'id_admin' => $adminId,
            ],
            [
                'judul_edukasi' => 'Prinsip 3R (Reduce, Reuse, Recycle)',
                'isi_materi' => "Prinsip 3R merupakan langkah utama dalam pengelolaan sampah berkelanjutan:\n\n1. Reduce (Mengurangi): Meminimalisir produksi sampah sejak awal. Contoh: membawa kantong belanja sendiri, mengurangi penggunaan plastik sekali pakai.\n2. Reuse (Menggunakan Kembali): Memanfaatkan kembali barang-barang bekas tanpa membuangnya terlebih dahulu. Contoh: menggunakan botol minum isi ulang, memakai wadah bekas untuk pot tanaman.\n3. Recycle (Mendaur Ulang): Mengolah kembali sampah menjadi produk baru yang bermanfaat. Contoh: membuat kerajinan dari sedotan, mengirim botol plastik ke bank sampah untuk dicacah menjadi bijih plastik.",
                'id_admin' => $adminId,
            ],
            [
                'judul_edukasi' => 'Sanitasi Air Bersih & Higienitas',
                'isi_materi' => "Sanitasi air bersih adalah upaya menjaga kebersihan air dari berbagai pencemaran seperti limbah industri, limbah domestik, dan bakteri e-coli. Air bersih adalah hak dasar dan kebutuhan vital bagi kehidupan manusia.\n\nCara menjaga sanitasi air:\n- Membuat sumur resapan dan menjaga jarak septic tank minimal 10 meter dari sumber air.\n- Tidak membuang sampah atau limbah detergen langsung ke sungai atau parit.\n- Melakukan penyaringan sederhana dan memasak air hingga mendidih sebelum dikonsumsi.\n\nSanitasi yang buruk dapat memicu wabah penyakit diare, kolera, dan stunting pada anak-anak.",
                'id_admin' => $adminId,
            ],
        ];

        foreach ($materi as $item) {
            Edukasi::firstOrCreate(
                ['judul_edukasi' => $item['judul_edukasi']],
                $item
            );
        }
    }
}
