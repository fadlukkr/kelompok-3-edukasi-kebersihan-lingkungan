<?php

namespace App\Http\Controllers;

use App\Models\Edukasi;
use App\Models\Jawaban;
use App\Models\Laporan;
use App\Models\Masyarakat;
use App\Models\Soal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Tampilkan panel control admin dengan seluruh data statistik dan pengelolaan.
     */
    public function index(Request $request): View
    {
        $admin = Auth::guard('admin')->user();

        // 1. Data Statistik Ringkasan
        $totalWarga = Masyarakat::count();
        $totalLaporan = Laporan::count();
        $totalVerifikasi = Laporan::where('status_verifikasi', 'terverifikasi')->count();
        $totalPending = Laporan::where('status_verifikasi', 'menunggu')->count();
        $totalDitolak = Laporan::where('status_verifikasi', 'ditolak')->count();

        $avgScore = (int) round((float) (Jawaban::avg('skor') ?? 0));
        $totalExams = Jawaban::count();
        $passCount = Jawaban::where('status_kelulusan', 'Lulus')->count();
        $passRate = $totalExams > 0 ? (int) round(($passCount / $totalExams) * 100) : 0;

        $pctVerif = $totalLaporan > 0 ? (int) round(($totalVerifikasi / $totalLaporan) * 100) : 0;
        $pctPending = $totalLaporan > 0 ? (int) round(($totalPending / $totalLaporan) * 100) : 0;
        $pctDitolak = $totalLaporan > 0 ? (int) round(($totalDitolak / $totalLaporan) * 100) : 0;

        // 2. Data Tabel Dashboard Utama
        $pendingReports = Laporan::where('status_verifikasi', 'menunggu')
            ->latest('id_laporan')
            ->take(4)
            ->get();

        $recentQuizzes = Jawaban::with('masyarakat')
            ->latest('id_jawaban')
            ->take(4)
            ->get();

        // 3. Data Kelola Edukasi
        $rawMaterials = Edukasi::latest('id_edukasi')->get();
        $materials = $rawMaterials->map(function ($item) {
            $judul = strtolower($item->judul_edukasi);
            if (str_contains($judul, 'organik') || str_contains($judul, 'sampah')) {
                $item->kategori = 'Pengenalan Sampah';
            } elseif (str_contains($judul, '3r') || str_contains($judul, 'daur ulang')) {
                $item->kategori = 'Daur Ulang';
            } elseif (str_contains($judul, 'air') || str_contains($judul, 'sanitasi')) {
                $item->kategori = 'Kesehatan Lingkungan';
            } else {
                $item->kategori = 'Edukasi Lingkungan';
            }

            return $item;
        });

        // 4. Data Kelola Kuis
        $quizzes = Soal::latest('id_soal')->get();

        // 5. Data Verifikasi Laporan
        $allReports = Laporan::latest('id_laporan')->get();

        $activeTab = $request->query('tab', 'dashboard');

        return view('admin.dashboard', compact(
            'admin',
            'totalWarga',
            'totalLaporan',
            'totalVerifikasi',
            'totalPending',
            'totalDitolak',
            'avgScore',
            'totalExams',
            'passRate',
            'pctVerif',
            'pctPending',
            'pctDitolak',
            'pendingReports',
            'recentQuizzes',
            'materials',
            'quizzes',
            'allReports',
            'activeTab'
        ));
    }

    /**
     * Simpan atau perbarui materi edukasi oleh admin.
     */
    public function saveMateri(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_edukasi' => 'nullable|integer|exists:edukasi,id_edukasi',
            'judul_edukasi' => 'required|string|max:255',
            'isi_materi' => 'required|string|min:10',
        ]);

        $adminId = Auth::guard('admin')->id();

        if (! empty($validated['id_edukasi'])) {
            $materi = Edukasi::findOrFail($validated['id_edukasi']);
            $materi->update([
                'judul_edukasi' => $validated['judul_edukasi'],
                'isi_materi' => $validated['isi_materi'],
            ]);
            $msg = 'Materi edukasi berhasil diperbarui.';
        } else {
            Edukasi::create([
                'judul_edukasi' => $validated['judul_edukasi'],
                'isi_materi' => $validated['isi_materi'],
                'tanggal_upload' => now(),
                'id_admin' => $adminId,
            ]);
            $msg = 'Materi edukasi baru berhasil ditambahkan.';
        }

        return redirect()->route('admin.dashboard', ['tab' => 'kelola-materi'])
            ->with('success', $msg);
    }

    /**
     * Hapus materi edukasi oleh admin.
     */
    public function destroyMateri(Edukasi $edukasi): RedirectResponse
    {
        $edukasi->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'kelola-materi'])
            ->with('success', 'Materi edukasi berhasil dihapus.');
    }

    /**
     * Tambah soal kuis baru oleh admin.
     */
    public function storeKuis(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'pertanyaan' => 'required|string',
            'opsi_a' => 'required|string|max:255',
            'opsi_b' => 'required|string|max:255',
            'opsi_c' => 'required|string|max:255',
            'opsi_d' => 'required|string|max:255',
            'jawaban_benar' => 'required|in:A,B,C,D',
        ]);

        $validated['id_admin'] = Auth::guard('admin')->id();

        Soal::create($validated);

        return redirect()->route('admin.dashboard', ['tab' => 'kelola-kuis'])
            ->with('success', 'Soal kuis baru berhasil disimpan.');
    }

    /**
     * Hapus soal kuis oleh admin.
     */
    public function destroyKuis(Soal $soal): RedirectResponse
    {
        $soal->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'kelola-kuis'])
            ->with('success', 'Soal kuis berhasil dihapus.');
    }

    /**
     * Ubah status verifikasi laporan warga (menunggu / terverifikasi / ditolak).
     */
    public function updateLaporanStatus(Request $request, Laporan $laporan): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:menunggu,terverifikasi,ditolak',
        ]);

        $laporan->update([
            'status_verifikasi' => $validated['status'],
            'id_admin' => Auth::guard('admin')->id(),
        ]);

        $statusLabel = match ($validated['status']) {
            'terverifikasi' => 'Terverifikasi',
            'ditolak' => 'Ditolak',
            default => 'Menunggu',
        };

        $msg = "Laporan {$laporan->nama_pelapor} telah diubah menjadi {$statusLabel}.";

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $msg,
                'status' => $validated['status'],
            ]);
        }

        $tab = $request->input('redirect_tab', 'verifikasi-laporan');

        return redirect()->route('admin.dashboard', ['tab' => $tab])
            ->with('success', $msg);
    }

    /**
     * Hapus pengaduan laporan warga oleh admin.
     */
    public function destroyLaporan(Laporan $laporan): RedirectResponse
    {
        $laporan->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'verifikasi-laporan'])
            ->with('success', 'Laporan warga berhasil dibersihkan.');
    }
}
