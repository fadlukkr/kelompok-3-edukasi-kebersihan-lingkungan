<?php

namespace App\Http\Controllers;

use App\Models\Edukasi;
use App\Models\Feedback;
use App\Models\Jawaban;
use App\Models\Laporan;
use App\Models\Soal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard masyarakat dengan data terintegrasi.
     */
    public function index(Request $request): View
    {
        $masyarakat = Auth::user();

        // 1. Ambil data edukasi dan tentukan kategori untuk UI
        $rawEdukasi = Edukasi::latest()->get();
        $materiList = $rawEdukasi->map(function ($item) {
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

        $totalMateri = $materiList->count();

        // 2. Data Kuis & Riwayat Nilai
        $soalList = Soal::all();
        $riwayatKuis = Jawaban::where('id_masyarakat', $masyarakat->id_masyarakat)
            ->latest()
            ->get();
        $skorTertinggi = $riwayatKuis->max('skor');

        // 3. Data Laporan Pengguna
        $laporanUser = Laporan::where('id_masyarakat', $masyarakat->id_masyarakat)
            ->latest()
            ->get();
        $totalLaporan = $laporanUser->count();

        $activeTab = $request->query('tab', 'beranda');

        return view('dashboard', compact(
            'masyarakat',
            'materiList',
            'totalMateri',
            'soalList',
            'riwayatKuis',
            'skorTertinggi',
            'laporanUser',
            'totalLaporan',
            'activeTab'
        ));
    }

    /**
     * Submit jawaban kuis oleh masyarakat.
     */
    public function submitKuis(Request $request): JsonResponse|RedirectResponse
    {
        $soalList = Soal::all();
        if ($soalList->isEmpty()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Bank soal kuis belum tersedia.',
                ], 422);
            }

            return redirect()->route('dashboard', ['tab' => 'kuis'])
                ->with('error', 'Bank soal kuis belum tersedia.');
        }

        $answers = $request->input('answers', []);
        $answeredCount = 0;
        $correctCount = 0;

        foreach ($soalList as $soal) {
            $userAnswer = $answers[$soal->id_soal] ?? $request->input('question_'.$soal->id_soal) ?? $request->input('question-'.$soal->id_soal);

            if ($userAnswer !== null && $userAnswer !== '') {
                $answeredCount++;
                if (strtoupper((string) $userAnswer) === strtoupper($soal->jawaban_benar)) {
                    $correctCount++;
                }
            }
        }

        if ($answeredCount < $soalList->count()) {
            $msg = "Mohon isi seluruh soal kuis ({$answeredCount}/{$soalList->count()} Terjawab).";
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $msg,
                ], 422);
            }

            return redirect()->route('dashboard', ['tab' => 'kuis'])
                ->with('error', $msg);
        }

        $score = (int) round(($correctCount / $soalList->count()) * 100);
        $status = $score >= 70 ? 'Lulus' : 'Gagal';

        $jawaban = Jawaban::create([
            'id_masyarakat' => Auth::id(),
            'skor' => $score,
            'status_kelulusan' => $status,
        ]);

        $message = $status === 'Lulus'
            ? "Hebat! Anda LULUS dengan skor {$score}!"
            : "Skor Anda {$score}. Anda belum mencapai kriteria kelulusan (70). Silakan coba lagi!";

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'score' => $score,
                'status' => $status,
                'date' => $jawaban->created_at->format('Y-m-d'),
                'message' => $message,
            ]);
        }

        $type = $status === 'Lulus' ? 'success' : 'error';

        return redirect()->route('dashboard', ['tab' => 'kuis'])
            ->with($type, $message);
    }

    /**
     * Simpan pengaduan kondisi lingkungan dari masyarakat.
     */
    public function storeLaporan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul_laporan' => 'required|string|max:150',
            'nama_pelapor' => 'required|string|max:100',
            'lokasi' => 'required|string|max:255',
            'kategori' => 'required|in:Sampah Liar,Saluran Tersumbat,Pencemaran Air,Lainnya',
            'deskripsi' => 'required|string',
            'bukti' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:4096',
        ]);

        if ($request->hasFile('bukti')) {
            $validated['bukti'] = $request->file('bukti')->store('bukti_laporan', 'public');
        }

        $validated['id_masyarakat'] = Auth::id();
        $validated['status_verifikasi'] = 'menunggu';

        Laporan::create($validated);

        return redirect()->route('dashboard', ['tab' => 'laporan'])
            ->with('success', 'Laporan Anda berhasil dikirim ke server. Status: menunggu verifikasi.');
    }

    /**
     * Simpan masukan / saran aplikasi dari masyarakat.
     */
    public function storeFeedback(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'pesan' => 'required|string',
        ]);

        $validated['id_masyarakat'] = Auth::id();

        Feedback::create($validated);

        return redirect()->route('dashboard', ['tab' => 'laporan'])
            ->with('success', 'Saran & kritik Anda sangat kami hargai. Terima kasih!');
    }
}
