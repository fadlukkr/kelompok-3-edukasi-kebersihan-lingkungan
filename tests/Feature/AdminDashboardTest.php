<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Edukasi;
use App\Models\Laporan;
use App\Models\Masyarakat;
use App\Models\Soal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    private Admin $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = Admin::create([
            'nama_admin' => 'Administrator',
            'email' => 'admin@ecolearn.ac.id',
            'password_hash' => Hash::make('admin123'),
            'status' => 'aktif',
        ]);
    }

    /**
     * Test tamu yang belum login dialihkan ke halaman login.
     */
    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('login'));
    }

    /**
     * Test masyarakat biasa tidak dapat mengakses dashboard admin.
     */
    public function test_regular_user_cannot_access_admin_dashboard(): void
    {
        $masyarakat = Masyarakat::create([
            'nama_lengkap' => 'Warga Biasa',
            'email' => 'warga@email.com',
            'password_hash' => Hash::make('password123'),
            'status' => 'aktif',
        ]);

        $response = $this->actingAs($masyarakat, 'web')->get(route('admin.dashboard'));
        $response->assertRedirect(route('login'));
    }

    /**
     * Test admin yang login dapat mengakses dashboard admin dan melihat seluruh panel.
     */
    public function test_admin_can_access_dashboard_and_see_components(): void
    {
        $response = $this->actingAs($this->admin, 'admin')->get(route('admin.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Panel Control Admin');
        $response->assertSee('Administrator');
        $response->assertSee('Kelola Materi Edukasi');
        $response->assertSee('Kelola Soal');
        $response->assertSee('Panel Verifikasi Laporan Warga');
        $response->assertSee('Statistik Data Penggunaan EcoLearn');
    }

    /**
     * Test admin dapat menambah materi baru melalui form dashboard.
     */
    public function test_admin_can_create_new_material(): void
    {
        $payload = [
            'judul_edukasi' => 'Pemanfaatan Sampah Organik Menjadi Kompos',
            'isi_materi' => 'Kompos adalah pupuk alami yang dibuat dari sisa-sisa organik rumah tangga seperti sayuran dan buah.',
        ];

        $response = $this->actingAs($this->admin, 'admin')
            ->post(route('admin.materi.save'), $payload);

        $response->assertRedirect(route('admin.dashboard', ['tab' => 'kelola-materi']));
        $this->assertDatabaseHas('edukasi', [
            'judul_edukasi' => 'Pemanfaatan Sampah Organik Menjadi Kompos',
        ]);
    }

    /**
     * Test admin dapat mengedit materi yang sudah ada.
     */
    public function test_admin_can_update_existing_material(): void
    {
        $edukasi = Edukasi::create([
            'judul_edukasi' => 'Judul Lama',
            'isi_materi' => 'Isi materi lama sebelum dilakukan proses update.',
            'id_admin' => $this->admin->id_admin,
            'tanggal_upload' => now(),
        ]);

        $payload = [
            'id_edukasi' => $edukasi->id_edukasi,
            'judul_edukasi' => 'Judul Baru Diperbarui',
            'isi_materi' => 'Isi materi telah berhasil diperbarui oleh admin.',
        ];

        $response = $this->actingAs($this->admin, 'admin')
            ->post(route('admin.materi.save'), $payload);

        $response->assertRedirect(route('admin.dashboard', ['tab' => 'kelola-materi']));
        $this->assertDatabaseHas('edukasi', [
            'id_edukasi' => $edukasi->id_edukasi,
            'judul_edukasi' => 'Judul Baru Diperbarui',
        ]);
    }

    /**
     * Test admin dapat menghapus materi edukasi.
     */
    public function test_admin_can_delete_material(): void
    {
        $edukasi = Edukasi::create([
            'judul_edukasi' => 'Materi Untuk Dihapus',
            'isi_materi' => 'Isi materi ini akan segera dihapus oleh admin aplikasi.',
            'id_admin' => $this->admin->id_admin,
            'tanggal_upload' => now(),
        ]);

        $response = $this->actingAs($this->admin, 'admin')
            ->delete(route('admin.materi.destroy', $edukasi->id_edukasi));

        $response->assertRedirect(route('admin.dashboard', ['tab' => 'kelola-materi']));
        $this->assertDatabaseMissing('edukasi', [
            'id_edukasi' => $edukasi->id_edukasi,
        ]);
    }

    /**
     * Test admin dapat menambahkan bank soal kuis baru.
     */
    public function test_admin_can_add_quiz_question(): void
    {
        $payload = [
            'pertanyaan' => 'Berapa jarak ideal septic tank dari sumur resapan?',
            'opsi_a' => '1 meter',
            'opsi_b' => '5 meter',
            'opsi_c' => '10 meter',
            'opsi_d' => '20 meter',
            'jawaban_benar' => 'C',
        ];

        $response = $this->actingAs($this->admin, 'admin')
            ->post(route('admin.kuis.store'), $payload);

        $response->assertRedirect(route('admin.dashboard', ['tab' => 'kelola-kuis']));
        $this->assertDatabaseHas('soal', [
            'pertanyaan' => 'Berapa jarak ideal septic tank dari sumur resapan?',
            'jawaban_benar' => 'C',
        ]);
    }

    /**
     * Test admin dapat memverifikasi laporan masyarakat menjadi terverifikasi.
     */
    public function test_admin_can_verify_citizen_report(): void
    {
        $masyarakat = Masyarakat::create([
            'nama_lengkap' => 'Warga Pelapor',
            'email' => 'pelapor@email.com',
            'password_hash' => Hash::make('password123'),
            'status' => 'aktif',
        ]);

        $laporan = Laporan::create([
            'id_masyarakat' => $masyarakat->id_masyarakat,
            'judul_laporan' => 'Tumpukan Sampah Liar',
            'nama_pelapor' => 'Warga Pelapor',
            'lokasi' => 'Jl. Kenanga No. 5',
            'kategori' => 'Sampah Liar',
            'deskripsi' => 'Sampah menggunung di pojok jalan.',
            'status_verifikasi' => 'menunggu',
        ]);

        $response = $this->actingAs($this->admin, 'admin')
            ->patch(route('admin.laporan.status', $laporan->id_laporan), [
                'status' => 'terverifikasi',
            ]);

        $response->assertRedirect(route('admin.dashboard', ['tab' => 'verifikasi-laporan']));
        $this->assertDatabaseHas('laporan', [
            'id_laporan' => $laporan->id_laporan,
            'status_verifikasi' => 'terverifikasi',
        ]);
    }

    /**
     * Test admin dapat menghapus laporan masyarakat.
     */
    public function test_admin_can_delete_citizen_report(): void
    {
        $masyarakat = Masyarakat::create([
            'nama_lengkap' => 'Warga Pelapor',
            'email' => 'pelapor2@email.com',
            'password_hash' => Hash::make('password123'),
            'status' => 'aktif',
        ]);

        $laporan = Laporan::create([
            'id_masyarakat' => $masyarakat->id_masyarakat,
            'judul_laporan' => 'Laporan Yang Ingin Dihapus',
            'nama_pelapor' => 'Warga Pelapor',
            'lokasi' => 'Jl. Melati',
            'kategori' => 'Lainnya',
            'deskripsi' => 'Data tidak relevan.',
            'status_verifikasi' => 'ditolak',
        ]);

        $response = $this->actingAs($this->admin, 'admin')
            ->delete(route('admin.laporan.destroy', $laporan->id_laporan));

        $response->assertRedirect(route('admin.dashboard', ['tab' => 'verifikasi-laporan']));
        $this->assertDatabaseMissing('laporan', [
            'id_laporan' => $laporan->id_laporan,
        ]);
    }
}
