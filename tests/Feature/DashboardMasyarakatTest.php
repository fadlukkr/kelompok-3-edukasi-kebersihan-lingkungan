<?php

namespace Tests\Feature;

use App\Models\Masyarakat;
use App\Models\Soal;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DashboardMasyarakatTest extends TestCase
{
    use RefreshDatabase;

    private Masyarakat $masyarakat;

    protected function setUp(): void
    {
        parent::setUp();

        $this->masyarakat = Masyarakat::create([
            'nama_lengkap' => 'Budi Santoso',
            'email' => 'budisantoso@email.com',
            'password_hash' => Hash::make('password123'),
            'status' => 'aktif',
        ]);
    }

    /**
     * Test tamu tanpa login dialihkan ke halaman login.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('dashboard'));
        $response->assertRedirect(route('login'));
    }

    /**
     * Test masyarakat yang login dapat melihat dashboard sesuai tampilan HTML mock.
     */
    public function test_masyarakat_can_view_dashboard_with_all_sections(): void
    {
        // Buat soal kuis dummy
        Soal::create([
            'pertanyaan' => 'Contoh sampah organik adalah?',
            'opsi_a' => 'Kaca',
            'opsi_b' => 'Daun',
            'opsi_c' => 'Plastik',
            'opsi_d' => 'Kaleng',
            'jawaban_benar' => 'B',
        ]);

        $response = $this->actingAs($this->masyarakat, 'web')->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Budi Santoso');
        $response->assertSee('Masyarakat');
        $response->assertSee('Katalog Materi Edukasi');
        $response->assertSee('Kuis Pengetahuan Lingkungan');
        $response->assertSee('Laporan Kondisi Lingkungan');
        $response->assertSee('Feedback Aplikasi');
    }

    /**
     * Test masyarakat dapat mengirim kuis dan skor tersimpan di database.
     */
    public function test_masyarakat_can_submit_quiz(): void
    {
        $soal = Soal::create([
            'pertanyaan' => 'Contoh sampah organik?',
            'opsi_a' => 'Kaca',
            'opsi_b' => 'Daun',
            'opsi_c' => 'Plastik',
            'opsi_d' => 'Kaleng',
            'jawaban_benar' => 'B',
        ]);

        $payload = [
            'answers' => [
                $soal->id_soal => 'B',
            ],
        ];

        $response = $this->actingAs($this->masyarakat, 'web')
            ->post(route('dashboard.kuis.submit'), $payload);

        $response->assertRedirect(route('dashboard', ['tab' => 'kuis']));
        $this->assertDatabaseHas('jawaban', [
            'id_masyarakat' => $this->masyarakat->id_masyarakat,
            'skor' => 100,
            'status_kelulusan' => 'Lulus',
        ]);
    }

    /**
     * Test masyarakat dapat mengirim laporan kerusakan/kebersihan lingkungan.
     */
    public function test_masyarakat_can_submit_laporan(): void
    {
        Storage::fake('public');

        $payload = [
            'judul_laporan' => 'Tumpukan Sampah di Jalan Mawar',
            'nama_pelapor' => 'Budi Santoso',
            'lokasi' => 'Jl. Mawar RT 01 RW 02',
            'kategori' => 'Sampah Liar',
            'deskripsi' => 'Banyak sampah berserakan di pinggir jalan dan berbau.',
            'bukti' => UploadedFile::fake()->create('bukti.jpg', 100, 'image/jpeg'),
        ];

        $response = $this->actingAs($this->masyarakat, 'web')
            ->post(route('dashboard.laporan.store'), $payload);

        $response->assertRedirect(route('dashboard', ['tab' => 'laporan']));
        $this->assertDatabaseHas('laporan', [
            'id_masyarakat' => $this->masyarakat->id_masyarakat,
            'judul_laporan' => 'Tumpukan Sampah di Jalan Mawar',
            'status_verifikasi' => 'menunggu',
        ]);
    }

    /**
     * Test masyarakat dapat mengirim feedback aplikasi.
     */
    public function test_masyarakat_can_submit_feedback(): void
    {
        $payload = [
            'nama' => 'Budi Santoso',
            'pesan' => 'Aplikasi sangat bermanfaat dan tampilannya bersih.',
        ];

        $response = $this->actingAs($this->masyarakat, 'web')
            ->post(route('dashboard.feedback.store'), $payload);

        $response->assertRedirect(route('dashboard', ['tab' => 'laporan']));
        $this->assertDatabaseHas('feedback', [
            'id_masyarakat' => $this->masyarakat->id_masyarakat,
            'nama' => 'Budi Santoso',
            'pesan' => 'Aplikasi sangat bermanfaat dan tampilannya bersih.',
        ]);
    }
}
