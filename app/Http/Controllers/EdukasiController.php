<?php

namespace App\Http\Controllers;

use App\Models\Edukasi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Throwable;

class EdukasiController extends Controller
{
    /**
     * Menampilkan daftar semua materi edukasi.
     */
    public function index(): View
    {
        $materi = Edukasi::with('admin')->latest('id_edukasi')->paginate(10);

        return view('edukasi.index', compact('materi'));
    }

    /**
     * Menampilkan form untuk menambahkan materi baru.
     */
    public function create(): View
    {
        return view('edukasi.create');
    }

    /**
     * Menyimpan materi edukasi baru ke database dengan validasi judul dan isi materi.
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        // Normalisasi input jika form mengirimkan 'judul' atau 'isi'
        if ($request->filled('judul') && ! $request->filled('judul_edukasi')) {
            $request->merge(['judul_edukasi' => $request->input('judul')]);
        }

        if ($request->filled('isi') && ! $request->filled('isi_materi')) {
            $request->merge(['isi_materi' => $request->input('isi')]);
        }

        // Validasi judul dan isi materi
        $validated = $request->validate([
            'judul_edukasi' => 'required|string|max:255',
            'isi_materi' => 'required|string|min:10',
        ], [
            'judul_edukasi.required' => 'Judul materi wajib diisi.',
            'judul_edukasi.string' => 'Judul materi harus berupa teks.',
            'judul_edukasi.max' => 'Judul materi maksimal 255 karakter.',
            'isi_materi.required' => 'Isi materi wajib diisi.',
            'isi_materi.string' => 'Isi materi harus berupa teks.',
            'isi_materi.min' => 'Isi materi minimal berisi 10 karakter.',
        ]);

        // Tentukan admin pengunggah (dari sesi admin yang login atau admin default)
        $adminId = auth('admin')->id();

        try {
            $edukasi = Edukasi::create([
                'judul_edukasi' => $validated['judul_edukasi'],
                'isi_materi' => $validated['isi_materi'],
                'tanggal_upload' => now(),
                'id_admin' => $adminId,
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Materi edukasi berhasil ditambahkan.',
                    'data' => $edukasi,
                ], 201);
            }

            return redirect()->route('edukasi.index')
                ->with('success', 'Materi edukasi berhasil ditambahkan!');
        } catch (Throwable $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan saat menambahkan materi: '.$e->getMessage(),
                ], 500);
            }

            return back()->withInput()->with('error', 'Gagal menambahkan materi: '.$e->getMessage());
        }
    }

    /**
     * Menampilkan detail satu materi edukasi.
     */
    public function show(int|string $id): View|RedirectResponse|JsonResponse
    {
        $edukasi = Edukasi::with('admin')->find($id);

        if (! $edukasi) {
            if (request()->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Materi edukasi tidak ditemukan.',
                ], 404);
            }

            return redirect()->route('edukasi.index')
                ->with('error', 'Materi edukasi tidak ditemukan.');
        }

        return view('edukasi.show', compact('edukasi'));
    }

    /**
     * Menampilkan form untuk memperbarui materi edukasi yang sudah ada.
     */
    public function edit(int|string $id): View|RedirectResponse
    {
        $edukasi = Edukasi::find($id);

        if (! $edukasi) {
            return redirect()->route('edukasi.index')
                ->with('error', 'Materi edukasi tidak ditemukan.');
        }

        return view('edukasi.edit', compact('edukasi'));
    }

    /**
     * Memperbarui materi edukasi yang sudah tersimpan dengan validasi judul dan isi materi.
     */
    public function update(Request $request, int|string $id): RedirectResponse|JsonResponse
    {
        $edukasi = Edukasi::find($id);

        // Menangani jika data materi tidak ditemukan
        if (! $edukasi) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Materi edukasi tidak ditemukan.',
                ], 404);
            }

            return redirect()->route('edukasi.index')
                ->with('error', 'Materi edukasi tidak ditemukan.');
        }

        // Normalisasi input jika form mengirimkan 'judul' atau 'isi'
        if ($request->filled('judul') && ! $request->filled('judul_edukasi')) {
            $request->merge(['judul_edukasi' => $request->input('judul')]);
        }

        if ($request->filled('isi') && ! $request->filled('isi_materi')) {
            $request->merge(['isi_materi' => $request->input('isi')]);
        }

        // Validasi judul dan isi materi
        $validated = $request->validate([
            'judul_edukasi' => 'required|string|max:255',
            'isi_materi' => 'required|string|min:10',
        ], [
            'judul_edukasi.required' => 'Judul materi wajib diisi.',
            'judul_edukasi.string' => 'Judul materi harus berupa teks.',
            'judul_edukasi.max' => 'Judul materi maksimal 255 karakter.',
            'isi_materi.required' => 'Isi materi wajib diisi.',
            'isi_materi.string' => 'Isi materi harus berupa teks.',
            'isi_materi.min' => 'Isi materi minimal berisi 10 karakter.',
        ]);

        try {
            $edukasi->update([
                'judul_edukasi' => $validated['judul_edukasi'],
                'isi_materi' => $validated['isi_materi'],
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Materi edukasi berhasil diperbarui.',
                    'data' => $edukasi,
                ]);
            }

            return redirect()->route('edukasi.index')
                ->with('success', 'Materi edukasi berhasil diperbarui!');
        } catch (Throwable $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan saat memperbarui materi: '.$e->getMessage(),
                ], 500);
            }

            return back()->withInput()->with('error', 'Gagal memperbarui materi: '.$e->getMessage());
        }
    }

    /**
     * Menghapus materi edukasi dari database dan menangani hasil operasi.
     */
    public function destroy(Request $request, int|string $id): RedirectResponse|JsonResponse
    {
        $edukasi = Edukasi::find($id);

        // Menangani jika data materi tidak ditemukan
        if (! $edukasi) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Materi edukasi tidak ditemukan.',
                ], 404);
            }

            return redirect()->route('edukasi.index')
                ->with('error', 'Materi edukasi tidak ditemukan.');
        }

        try {
            $edukasi->delete();

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Materi edukasi berhasil dihapus.',
                ]);
            }

            return redirect()->route('edukasi.index')
                ->with('success', 'Materi edukasi berhasil dihapus!');
        } catch (Throwable $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan saat menghapus materi: '.$e->getMessage(),
                ], 500);
            }

            return redirect()->route('edukasi.index')
                ->with('error', 'Gagal menghapus materi: '.$e->getMessage());
        }
    }
}
