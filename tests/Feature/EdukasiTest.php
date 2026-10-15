<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Edukasi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EdukasiTest extends TestCase
{
    use RefreshDatabase;

    private Admin $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::firstOrCreate(
            ['email' => 'admin@ecolearn.ac.id'],
            [
                'nama_admin' => 'Administrator',
                'password_hash' => Hash::make('admin123'),
                'status' => 'aktif',
            ]
        );
        $this->actingAs($this->admin, 'admin');
    }

    /**
     * Test menampilkan halaman daftar materi edukasi.
     */
    public function test_can_render_edukasi_index_page(): void
    {
        $response = $this->get(route('edukasi.index'));

        $response->assertStatus(200);
        $response->assertSee('Katalog Materi Edukasi');
    }

    /**
     * Test menampilkan halaman tambah materi.
     */
    public function test_can_render_edukasi_create_page(): void
    {
        $response = $this->get(route('edukasi.create'));

        $response->assertStatus(200);
        $response->assertSee('Tambah Materi Edukasi Baru');
    }

    /**
     * Test menyimpan materi baru dengan validasi berhasil dan penanganan pesan sukses.
     */
    public function test_can_store_materi_with_valid_data(): void
    {
        $payload = [
            'judul_edukasi' => 'Pentingnya Memilah Sampah dari Rumah',
            'isi_materi' => 'Memilah sampah organik dan anorganik dapat mempermudah proses daur ulang secara berkelanjutan.',
        ];

        $response = $this->post(route('edukasi.store'), $payload);

        $response->assertRedirect(route('edukasi.index'));
        $response->assertSessionHas('success', 'Materi edukasi berhasil ditambahkan!');

        $this->assertDatabaseHas('edukasi', [
            'judul_edukasi' => 'Pentingnya Memilah Sampah dari Rumah',
        ]);
    }

    /**
     * Test validasi gagal jika judul materi kosong.
     */
    public function test_store_fails_when_judul_is_missing(): void
    {
        $payload = [
            'judul_edukasi' => '',
            'isi_materi' => 'Konten materi edukasi yang cukup panjang lebih dari 10 karakter.',
        ];

        $response = $this->post(route('edukasi.store'), $payload);

        $response->assertSessionHasErrors(['judul_edukasi']);
    }

    /**
     * Test validasi gagal jika isi materi kurang dari 10 karakter.
     */
    public function test_store_fails_when_isi_materi_is_too_short(): void
    {
        $payload = [
            'judul_edukasi' => 'Pengelolaan Limbah',
            'isi_materi' => 'Pendek',
        ];

        $response = $this->post(route('edukasi.store'), $payload);

        $response->assertSessionHasErrors(['isi_materi']);
    }

    /**
     * Test memperbarui materi yang sudah tersimpan dengan validasi berhasil.
     */
    public function test_can_update_saved_materi(): void
    {
        $materi = Edukasi::create([
            'judul_edukasi' => 'Materi Lama',
            'isi_materi' => 'Isi materi lama yang akan diperbarui.',
            'id_admin' => $this->admin->id_admin,
            'tanggal_upload' => now(),
        ]);

        $updatePayload = [
            'judul_edukasi' => 'Materi Baru Diperbarui',
            'isi_materi' => 'Isi materi edukasi versi terbaru yang telah disesuaikan.',
        ];

        $response = $this->put(route('edukasi.update', $materi->id_edukasi), $updatePayload);

        $response->assertRedirect(route('edukasi.index'));
        $response->assertSessionHas('success', 'Materi edukasi berhasil diperbarui!');

        $this->assertDatabaseHas('edukasi', [
            'id_edukasi' => $materi->id_edukasi,
            'judul_edukasi' => 'Materi Baru Diperbarui',
        ]);
    }

    /**
     * Test memperbarui materi gagal jika validasi tidak terpenuhi.
     */
    public function test_update_fails_when_validation_fails(): void
    {
        $materi = Edukasi::create([
            'judul_edukasi' => 'Materi Asli',
            'isi_materi' => 'Konten asli materi edukasi sebelum diupdate.',
            'id_admin' => $this->admin->id_admin,
            'tanggal_upload' => now(),
        ]);

        $response = $this->put(route('edukasi.update', $materi->id_edukasi), [
            'judul_edukasi' => '',
            'isi_materi' => 'pendek',
        ]);

        $response->assertSessionHasErrors(['judul_edukasi', 'isi_materi']);
    }

    /**
     * Test penanganan operasi jika materi yang ingin diperbarui tidak ditemukan.
     */
    public function test_update_handles_not_found_material(): void
    {
        $response = $this->put(route('edukasi.update', 999999), [
            'judul_edukasi' => 'Judul Valid',
            'isi_materi' => 'Isi materi yang valid dan lebih dari 10 karakter.',
        ]);

        $response->assertRedirect(route('edukasi.index'));
        $response->assertSessionHas('error', 'Materi edukasi tidak ditemukan.');
    }

    /**
     * Test menghapus materi yang tersimpan dan menangani pesan sukses.
     */
    public function test_can_delete_materi(): void
    {
        $materi = Edukasi::create([
            'judul_edukasi' => 'Materi Yang Akan Dihapus',
            'isi_materi' => 'Isi materi ini akan segera dihapus untuk pengujian.',
            'id_admin' => $this->admin->id_admin,
            'tanggal_upload' => now(),
        ]);

        $response = $this->delete(route('edukasi.destroy', $materi->id_edukasi));

        $response->assertRedirect(route('edukasi.index'));
        $response->assertSessionHas('success', 'Materi edukasi berhasil dihapus!');

        $this->assertDatabaseMissing('edukasi', [
            'id_edukasi' => $materi->id_edukasi,
        ]);
    }

    /**
     * Test penanganan operasi jika materi yang ingin dihapus tidak ditemukan.
     */
    public function test_delete_handles_not_found_material(): void
    {
        $response = $this->delete(route('edukasi.destroy', 999999));

        $response->assertRedirect(route('edukasi.index'));
        $response->assertSessionHas('error', 'Materi edukasi tidak ditemukan.');
    }
}
