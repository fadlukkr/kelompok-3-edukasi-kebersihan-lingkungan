@extends('layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div id="admin-section" class="flex-1 flex flex-col">
  <!-- Navbar Admin -->
  <header class="bg-white border-b border-slate-100 shadow-sm sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Brand -->
        <div class="flex items-center gap-2 cursor-pointer" onclick="navigateToAdmin('dashboard')">
          <div class="w-9 h-9 bg-forest-600 text-white rounded-lg flex items-center justify-center shadow-md">
            <i data-lucide="leaf" class="w-5 h-5"></i>
          </div>
          <span class="font-bold text-lg text-slate-800 tracking-tight">EcoLearn <span class="text-xs bg-slate-100 text-slate-600 font-normal px-2 py-0.5 rounded-full ml-1.5">Admin</span></span>
        </div>

        <!-- Navigation Links -->
        <nav class="hidden md:flex items-center space-x-1">
          <button onclick="navigateToAdmin('dashboard')" id="nav-admin-dashboard" class="px-4 py-2 rounded-lg text-sm font-semibold text-forest-700 bg-forest-50 transition-all">Dashboard Admin</button>
          <button onclick="navigateToAdmin('kelola-materi')" id="nav-admin-kelola-materi" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:text-slate-900 transition-all">Kelola Edukasi</button>
          <button onclick="navigateToAdmin('kelola-kuis')" id="nav-admin-kelola-kuis" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:text-slate-900 transition-all">Kelola Kuis</button>
          <button onclick="navigateToAdmin('verifikasi-laporan')" id="nav-admin-verifikasi-laporan" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:text-slate-900 transition-all">Verifikasi Laporan</button>
          <button onclick="navigateToAdmin('statistik')" id="nav-admin-statistik" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:text-slate-900 transition-all">Statistik</button>
        </nav>

        <!-- Profile & Logout (UC-03) -->
        <div class="flex items-center gap-4">
          <div class="hidden sm:flex flex-col text-right">
            <span id="admin-profile-name" class="text-sm font-semibold text-slate-800">{{ $admin->nama_admin }}</span>
            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Mahasiswa / Admin</span>
          </div>
          <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="p-2 text-slate-400 hover:text-red-500 rounded-lg hover:bg-slate-50 transition-all" title="Keluar">
              <i data-lucide="log-out" class="w-5 h-5"></i>
            </button>
          </form>
          <!-- Mobile Menu Toggle -->
          <button onclick="toggleMobileMenu('admin-mobile-menu')" class="md:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-lg transition-all" aria-label="Menu">
            <i data-lucide="menu" class="w-6 h-6"></i>
          </button>
        </div>
      </div>
    </div>
    <!-- Mobile Navigation Drawer -->
    <div id="admin-mobile-menu" class="hidden md:hidden border-t border-slate-100 bg-white px-4 py-2 space-y-1 shadow-inner">
      <button onclick="navigateToAdmin('dashboard')" class="w-full text-left px-4 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 block">Dashboard Admin</button>
      <button onclick="navigateToAdmin('kelola-materi')" class="w-full text-left px-4 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 block">Kelola Edukasi</button>
      <button onclick="navigateToAdmin('kelola-kuis')" class="w-full text-left px-4 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 block">Kelola Kuis</button>
      <button onclick="navigateToAdmin('verifikasi-laporan')" class="w-full text-left px-4 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 block">Verifikasi Laporan</button>
      <button onclick="navigateToAdmin('statistik')" class="w-full text-left px-4 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 block">Statistik</button>
    </div>
  </header>

  <!-- Main Content Area -->
  <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 transition-all">

    <!-- ========================================================================= -->
    <!-- SUBSECTION: ADMIN DASHBOARD (UC-12 STATISTIK OVERVIEW) -->
    <!-- ========================================================================= -->
    <div id="section-admin-dashboard" class="space-y-8">
      <div>
        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Selamat Datang di Panel Control Admin</h2>
        <p class="text-sm text-slate-500 mt-1">Anda memiliki akses penuh untuk mengelola materi, bank soal kuis, serta memverifikasi pengaduan warga.</p>
      </div>

      <!-- STATISTIK CARDS (UC-12) -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="admin-stats-container">
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-md transition-all">
          <div class="w-12 h-12 rounded-xl bg-forest-100 text-forest-700 flex items-center justify-center">
            <i data-lucide="users" class="w-6 h-6"></i>
          </div>
          <div>
            <p class="text-xs text-slate-500 font-medium">Total Warga Terdaftar</p>
            <h4 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $totalWarga }} Orang</h4>
          </div>
        </div>
        <!-- Card 2 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-md transition-all">
          <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center">
            <i data-lucide="file-warning" class="w-6 h-6"></i>
          </div>
          <div>
            <p class="text-xs text-slate-500 font-medium">Total Laporan Masuk</p>
            <h4 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $totalLaporan }} Laporan</h4>
          </div>
        </div>
        <!-- Card 3 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-md transition-all">
          <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
            <i data-lucide="check-circle-2" class="w-6 h-6"></i>
          </div>
          <div>
            <p class="text-xs text-slate-500 font-medium">Laporan Terverifikasi</p>
            <h4 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $totalVerifikasi }} Laporan</h4>
          </div>
        </div>
        <!-- Card 4 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-md transition-all">
          <div class="w-12 h-12 rounded-xl bg-violet-100 text-violet-700 flex items-center justify-center">
            <i data-lucide="award" class="w-6 h-6"></i>
          </div>
          <div>
            <p class="text-xs text-slate-500 font-medium">Rata-rata Nilai Warga</p>
            <h4 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $avgScore }} Poin</h4>
          </div>
        </div>
      </div>

      <!-- Quick Access Table Lists -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Recent User Reports -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-4">
          <div class="flex justify-between items-center">
            <h3 class="font-bold text-slate-800 text-sm">Laporan Warga Perlu Tindakan</h3>
            <button onclick="navigateToAdmin('verifikasi-laporan')" class="text-xs font-semibold text-forest-600 hover:text-forest-700">Tampilkan Semua &rarr;</button>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-500">
              <thead class="bg-slate-50 text-slate-700 uppercase font-semibold">
                <tr>
                  <th class="p-3">Pelapor</th>
                  <th class="p-3">Status</th>
                  <th class="p-3 text-right">Aksi</th>
                </tr>
              </thead>
              <tbody id="admin-dash-reports" class="divide-y divide-slate-100">
                @forelse ($pendingReports as $r)
                  <tr>
                    <td class="p-3 font-semibold text-slate-800">{{ $r->nama_pelapor }}</td>
                    <td class="p-3"><span class="bg-amber-100 text-amber-800 px-2 py-0.5 rounded text-[10px] font-semibold uppercase tracking-wider">Menunggu</span></td>
                    <td class="p-3 text-right space-x-2">
                      <form action="{{ route('admin.laporan.status', $r->id_laporan) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="terverifikasi">
                        <input type="hidden" name="redirect_tab" value="dashboard">
                        <button type="submit" class="text-forest-600 hover:underline font-semibold">Verifikasi</button>
                      </form>
                      <form action="{{ route('admin.laporan.status', $r->id_laporan) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="ditolak">
                        <input type="hidden" name="redirect_tab" value="dashboard">
                        <button type="submit" class="text-red-600 hover:underline font-semibold">Tolak</button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3" class="p-4 text-center text-slate-400">Tidak ada pengaduan pending.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

        <!-- Recent Quiz History -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-4">
          <h3 class="font-bold text-slate-800 text-sm">Rekap Nilai Kuis Warga Terakhir</h3>
          <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-slate-500">
              <thead class="bg-slate-50 text-slate-700 uppercase font-semibold">
                <tr>
                  <th class="p-3">Nama Warga</th>
                  <th class="p-3">Skor</th>
                  <th class="p-3">Kelulusan</th>
                  <th class="p-3">Tanggal</th>
                </tr>
              </thead>
              <tbody id="admin-dash-quizzes" class="divide-y divide-slate-100">
                @forelse ($recentQuizzes as $q)
                  <tr>
                    <td class="p-3 font-semibold text-slate-800">{{ $q->masyarakat->nama_lengkap ?? 'Warga' }}</td>
                    <td class="p-3 font-semibold">{{ $q->skor }}</td>
                    <td class="p-3">
                      <span class="px-2 py-0.5 rounded text-[10px] uppercase font-semibold {{ $q->status_kelulusan === 'Lulus' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' }}">
                        {{ $q->status_kelulusan }}
                      </span>
                    </td>
                    <td class="p-3 text-slate-400">{{ $q->created_at->format('Y-m-d') }}</td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="4" class="p-4 text-center text-slate-400">Belum ada aktivitas kuis.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>

    <!-- ========================================================================= -->
    <!-- SUBSECTION: ADMIN KELOLA EDUKASI (UC-09) -->
    <!-- ========================================================================= -->
    <div id="section-admin-kelola-materi" class="hidden space-y-8">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Kelola Materi Edukasi</h2>
          <p class="text-sm text-slate-500 mt-1">Tambahkan topik edukasi baru, atau hapus konten materi edukasi yang sudah ada.</p>
        </div>
        <button onclick="openMaterialModal(null)" class="px-4 py-2 bg-forest-600 hover:bg-forest-700 text-white font-semibold text-xs rounded-xl shadow-md transition-all flex items-center gap-1.5 self-start">
          <i data-lucide="plus" class="w-4 h-4"></i> Tambah Materi Baru
        </button>
      </div>

      <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-700 uppercase text-xs font-semibold">
              <tr>
                <th class="p-4">Kategori</th>
                <th class="p-4">Judul Materi</th>
                <th class="p-4">Ringkasan</th>
                <th class="p-4 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody id="admin-materials-table" class="divide-y divide-slate-100 text-xs">
              @forelse ($materials as $mat)
                <tr>
                  <td class="p-4 font-semibold text-slate-800">{{ $mat->kategori }}</td>
                  <td class="p-4 font-medium">{{ $mat->judul_edukasi }}</td>
                  <td class="p-4 text-slate-500 max-w-xs truncate">{{ Str::limit(strip_tags($mat->isi_materi), 80) }}</td>
                  <td class="p-4 text-center space-x-2 whitespace-nowrap">
                    <button onclick="openMaterialModal({{ $mat->id_edukasi }})" class="px-2.5 py-1 text-xs border border-slate-200 rounded-lg hover:bg-slate-100 transition-all font-semibold">Edit</button>
                    <form action="{{ route('admin.materi.destroy', $mat->id_edukasi) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus materi edukasi ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="px-2.5 py-1 text-xs bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all font-semibold">Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="p-6 text-center text-slate-400 font-semibold text-xs">Belum ada materi edukasi terdaftar.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ========================================================================= -->
    <!-- SUBSECTION: ADMIN KELOLA KUIS (UC-10) -->
    <!-- ========================================================================= -->
    <div id="section-admin-kelola-kuis" class="hidden space-y-8">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Kelola Soal &amp; Kuis</h2>
          <p class="text-sm text-slate-500 mt-1">Lihat koleksi bank soal kuis atau tambahkan pertanyaan baru secara real-time.</p>
        </div>
        <button onclick="openQuizModal()" class="px-4 py-2 bg-forest-600 hover:bg-forest-700 text-white font-semibold text-xs rounded-xl shadow-md transition-all flex items-center gap-1.5 self-start">
          <i data-lucide="plus" class="w-4 h-4"></i> Tambah Soal Baru
        </button>
      </div>

      <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-4" id="admin-quiz-list">
        @forelse ($quizzes as $idx => $q)
          <div class="p-4 bg-slate-50 border border-slate-100 rounded-xl flex items-start justify-between gap-4">
            <div class="space-y-2 flex-1">
              <div class="flex items-center gap-2">
                <span class="px-2 py-0.5 bg-forest-100 text-forest-800 font-bold text-[10px] rounded">Soal {{ $idx + 1 }}</span>
              </div>
              <p class="text-sm font-semibold text-slate-800">{{ $q->pertanyaan }}</p>
              <ul class="pl-2 space-y-1">
                <li class="flex items-center gap-1.5 mt-1 text-xs">
                  <span class="w-1.5 h-1.5 rounded-full {{ $q->jawaban_benar === 'A' ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                  <span class="{{ $q->jawaban_benar === 'A' ? 'font-bold text-emerald-800' : 'text-slate-600' }}">A. {{ $q->opsi_a }}</span>
                  @if ($q->jawaban_benar === 'A')
                    <span class="text-[9px] font-bold text-emerald-600 ml-1 bg-emerald-50 px-1.5 rounded">Kunci</span>
                  @endif
                </li>
                <li class="flex items-center gap-1.5 mt-1 text-xs">
                  <span class="w-1.5 h-1.5 rounded-full {{ $q->jawaban_benar === 'B' ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                  <span class="{{ $q->jawaban_benar === 'B' ? 'font-bold text-emerald-800' : 'text-slate-600' }}">B. {{ $q->opsi_b }}</span>
                  @if ($q->jawaban_benar === 'B')
                    <span class="text-[9px] font-bold text-emerald-600 ml-1 bg-emerald-50 px-1.5 rounded">Kunci</span>
                  @endif
                </li>
                <li class="flex items-center gap-1.5 mt-1 text-xs">
                  <span class="w-1.5 h-1.5 rounded-full {{ $q->jawaban_benar === 'C' ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                  <span class="{{ $q->jawaban_benar === 'C' ? 'font-bold text-emerald-800' : 'text-slate-600' }}">C. {{ $q->opsi_c }}</span>
                  @if ($q->jawaban_benar === 'C')
                    <span class="text-[9px] font-bold text-emerald-600 ml-1 bg-emerald-50 px-1.5 rounded">Kunci</span>
                  @endif
                </li>
                <li class="flex items-center gap-1.5 mt-1 text-xs">
                  <span class="w-1.5 h-1.5 rounded-full {{ $q->jawaban_benar === 'D' ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                  <span class="{{ $q->jawaban_benar === 'D' ? 'font-bold text-emerald-800' : 'text-slate-600' }}">D. {{ $q->opsi_d }}</span>
                  @if ($q->jawaban_benar === 'D')
                    <span class="text-[9px] font-bold text-emerald-600 ml-1 bg-emerald-50 px-1.5 rounded">Kunci</span>
                  @endif
                </li>
              </ul>
            </div>
            <form action="{{ route('admin.kuis.destroy', $q->id_soal) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan kuis ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="px-2 py-1 bg-red-50 text-red-600 font-bold text-xs rounded-lg hover:bg-red-100 transition-all shrink-0">
                Hapus
              </button>
            </form>
          </div>
        @empty
          <p class="text-slate-400 text-center py-6 text-xs">Belum ada bank soal terdaftar.</p>
        @endforelse
      </div>
    </div>

    <!-- ========================================================================= -->
    <!-- SUBSECTION: ADMIN VERIFIKASI LAPORAN (UC-11) -->
    <!-- ========================================================================= -->
    <div id="section-admin-verifikasi-laporan" class="hidden space-y-6">
      <div>
        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Panel Verifikasi Laporan Warga</h2>
        <p class="text-sm text-slate-500 mt-1">Tinjau laporan kondisi lingkungan hidup dari masyarakat. Ubah status tindakan atau tolak laporan tidak valid.</p>
      </div>

      <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-700 uppercase text-xs font-semibold">
              <tr>
                <th class="p-4">Tanggal</th>
                <th class="p-4">Pelapor</th>
                <th class="p-4">Alamat</th>
                <th class="p-4">Kondisi</th>
                <th class="p-4">Bukti</th>
                <th class="p-4">Status</th>
                <th class="p-4 text-center">Aksi Verifikasi</th>
              </tr>
            </thead>
            <tbody id="admin-verification-table" class="divide-y divide-slate-100 text-xs">
              @forelse ($allReports as $r)
                <tr>
                  <td class="p-4 text-slate-400 font-semibold whitespace-nowrap">{{ $r->created_at->format('Y-m-d') }}</td>
                  <td class="p-4 font-bold text-slate-800">{{ $r->nama_pelapor }}</td>
                  <td class="p-4 max-w-[150px] truncate text-slate-500" title="{{ $r->lokasi }}">{{ $r->lokasi }}</td>
                  <td class="p-4 max-w-[220px] font-medium text-slate-700 leading-normal" title="{{ $r->deskripsi }}">{{ $r->deskripsi }}</td>
                  <td class="p-4">
                    @if ($r->bukti)
                      <a href="{{ asset('storage/' . $r->bukti) }}" target="_blank" class="text-forest-600 hover:underline flex items-center gap-1 font-semibold">
                        <i data-lucide="file" class="w-3.5 h-3.5"></i> Lihat
                      </a>
                    @else
                      <span class="text-slate-400">-</span>
                    @endif
                  </td>
                  <td class="p-4">
                    @if ($r->status_verifikasi === 'menunggu')
                      <span class="bg-amber-100 text-amber-800 font-semibold px-2 py-0.5 rounded text-[10px] uppercase">Menunggu</span>
                    @elseif ($r->status_verifikasi === 'terverifikasi')
                      <span class="bg-emerald-100 text-emerald-800 font-semibold px-2 py-0.5 rounded text-[10px] uppercase">Terverifikasi</span>
                    @else
                      <span class="bg-red-100 text-red-800 font-semibold px-2 py-0.5 rounded text-[10px] uppercase">Ditolak</span>
                    @endif
                  </td>
                  <td class="p-4 text-center space-x-2 whitespace-nowrap">
                    @if ($r->status_verifikasi === 'menunggu')
                      <form action="{{ route('admin.laporan.status', $r->id_laporan) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="terverifikasi">
                        <button type="submit" class="px-2.5 py-1 text-xs bg-emerald-50 text-emerald-700 rounded-lg hover:bg-emerald-100 transition-all font-semibold">Setujui</button>
                      </form>
                      <form action="{{ route('admin.laporan.status', $r->id_laporan) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="ditolak">
                        <button type="submit" class="px-2.5 py-1 text-xs bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-all font-semibold">Tolak</button>
                      </form>
                    @else
                      <form action="{{ route('admin.laporan.status', $r->id_laporan) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="menunggu">
                        <button type="submit" class="px-2.5 py-1 text-xs bg-amber-50 text-amber-700 rounded-lg hover:bg-amber-100 transition-all font-semibold">Kembali ke Menunggu</button>
                      </form>
                    @endif
                    <form action="{{ route('admin.laporan.destroy', $r->id_laporan) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan pengaduan warga ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="px-2.5 py-1 text-xs bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all font-semibold">Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="p-6 text-center text-slate-400 font-semibold text-xs">Belum ada laporan dari warga.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- ========================================================================= -->
    <!-- SUBSECTION: ADMIN STATISTIK DETAIL (UC-12) -->
    <!-- ========================================================================= -->
    <div id="section-admin-statistik" class="hidden space-y-8">
      <div>
        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Statistik Data Penggunaan EcoLearn</h2>
        <p class="text-sm text-slate-500 mt-1">Rekap rekapitulasi data pendaftaran warga, data pengaduan, dan efisiensi edukasi kuis secara keseluruhan.</p>
      </div>

      <!-- Big Data Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <!-- Detailed Report Status Chart Simulator -->
        <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm space-y-6">
          <h3 class="font-bold text-slate-800 text-base">Rasio Status Verifikasi Laporan</h3>

          <div class="space-y-4">
            <!-- Pending bar -->
            <div>
              <div class="flex justify-between text-xs font-medium text-slate-600 mb-1.5">
                <span>Laporan Menunggu (Pending)</span>
                <span id="stat-bar-pending-txt">{{ $pctPending }}% ({{ $totalPending }})</span>
              </div>
              <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                <div id="stat-bar-pending" class="h-full bg-amber-500 transition-all duration-500" style="width: {{ $pctPending }}%"></div>
              </div>
            </div>

            <!-- Verified bar -->
            <div>
              <div class="flex justify-between text-xs font-medium text-slate-600 mb-1.5">
                <span>Laporan Terverifikasi</span>
                <span id="stat-bar-verified-txt">{{ $pctVerif }}% ({{ $totalVerifikasi }})</span>
              </div>
              <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                <div id="stat-bar-verified" class="h-full bg-emerald-500 transition-all duration-500" style="width: {{ $pctVerif }}%"></div>
              </div>
            </div>

            <!-- Rejected bar -->
            <div>
              <div class="flex justify-between text-xs font-medium text-slate-600 mb-1.5">
                <span>Laporan Ditolak</span>
                <span id="stat-bar-rejected-txt">{{ $pctDitolak }}% ({{ $totalDitolak }})</span>
              </div>
              <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                <div id="stat-bar-rejected" class="h-full bg-red-500 transition-all duration-500" style="width: {{ $pctDitolak }}%"></div>
              </div>
            </div>
          </div>

          <p class="text-xs text-slate-400">Rasio didapatkan secara real-time dari hitungan total laporan yang masuk ke server EcoLearn.</p>
        </div>

        <!-- Quiz Score Stats Distribution Simulator -->
        <div class="bg-white p-8 rounded-2xl border border-slate-100 shadow-sm space-y-6">
          <h3 class="font-bold text-slate-800 text-base">Rangkuman Kuis Warga</h3>
          <div class="grid grid-cols-2 gap-4">
            <div class="bg-slate-50 p-4 rounded-xl text-center">
              <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Rata-rata Nilai</p>
              <h4 id="stat-avg-score" class="text-3xl font-extrabold text-forest-700 mt-1">{{ $avgScore }}</h4>
            </div>
            <div class="bg-slate-50 p-4 rounded-xl text-center">
              <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Tingkat Kelulusan</p>
              <h4 id="stat-pass-rate" class="text-3xl font-extrabold text-emerald-600 mt-1">{{ $passRate }}%</h4>
            </div>
          </div>
          <div class="border-t border-slate-100 pt-4 flex items-center justify-between text-xs text-slate-500">
            <span>Total Ujian Diselesaikan:</span>
            <span id="stat-total-exams" class="font-bold text-slate-800">{{ $totalExams }} Kali</span>
          </div>
        </div>

      </div>
    </div>

  </main>
</div>

<!-- ========================================================================= -->
<!-- [MODAL B] ADMIN ADD/EDIT MATERI FORM (UC-09) -->
<!-- ========================================================================= -->
<div id="modal-admin-materi" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full overflow-hidden border border-slate-100 animate-slideIn">
    <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50">
      <h3 id="modal-admin-materi-title" class="font-bold text-slate-800 text-base">Kelola Materi Edukasi</h3>
      <button onclick="closeMaterialFormModal()" class="p-1 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-all" aria-label="Tutup">
        <i data-lucide="x" class="w-6 h-6"></i>
      </button>
    </div>
    <form id="material-admin-form" method="POST" action="{{ route('admin.materi.save') }}" class="p-6 space-y-4">
      @csrf
      <input type="hidden" id="admin-mat-id" name="id_edukasi">
      <div>
        <label for="admin-mat-title" class="block text-xs font-semibold text-slate-600 mb-1.5">Judul Materi</label>
        <input type="text" id="admin-mat-title" name="judul_edukasi" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50">
      </div>
      <div>
        <label for="admin-mat-category" class="block text-xs font-semibold text-slate-600 mb-1.5">Kategori</label>
        <input type="text" id="admin-mat-category" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50" placeholder="Misal: Daur Ulang, Sanitasi, dll.">
      </div>
      <div>
        <label for="admin-mat-content" class="block text-xs font-semibold text-slate-600 mb-1.5">Konten Detail Materi</label>
        <textarea id="admin-mat-content" name="isi_materi" required rows="6" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50 custom-scrollbar" placeholder="Isi materi edukasi secara mendalam..."></textarea>
      </div>
      <div class="flex justify-end gap-2 pt-2 border-t border-slate-100">
        <button type="button" onclick="closeMaterialFormModal()" class="px-4 py-2 border border-slate-200 text-slate-600 font-semibold text-xs rounded-xl hover:bg-slate-50 transition-all">Batal</button>
        <button type="submit" class="px-4 py-2 bg-forest-600 hover:bg-forest-700 text-white font-semibold text-xs rounded-xl shadow-md transition-all">Simpan Konten</button>
      </div>
    </form>
  </div>
</div>

<!-- ========================================================================= -->
<!-- [MODAL C] ADMIN ADD SOAL FORM (UC-10) -->
<!-- ========================================================================= -->
<div id="modal-admin-quiz" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full overflow-hidden border border-slate-100 animate-slideIn">
    <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50">
      <h3 class="font-bold text-slate-800 text-base">Tambah Soal Baru</h3>
      <button onclick="closeQuizModal()" class="p-1 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-all" aria-label="Tutup">
        <i data-lucide="x" class="w-6 h-6"></i>
      </button>
    </div>
    <form id="quiz-admin-form" method="POST" action="{{ route('admin.kuis.store') }}" class="p-6 space-y-4">
      @csrf
      <div>
        <label for="admin-q-text" class="block text-xs font-semibold text-slate-600 mb-1.5">Pertanyaan</label>
        <textarea id="admin-q-text" name="pertanyaan" required rows="2.5" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50" placeholder="Ketik soal kuis..."></textarea>
      </div>
      <div class="space-y-3">
        <span class="block text-xs font-semibold text-slate-600">Pilihan Jawaban (Berikan Tanda Centang untuk Jawaban Benar)</span>

        <div class="flex items-center gap-2">
          <input type="radio" name="jawaban_benar" value="A" required class="text-forest-600 focus:ring-forest-500 h-4 w-4">
          <input type="text" id="admin-opt-A" name="opsi_a" required class="flex-1 px-3 py-1.5 border border-slate-200 rounded-xl text-slate-800 text-xs focus:outline-none focus:ring-2 focus:ring-forest-500 bg-slate-50" placeholder="Pilihan A">
        </div>
        <div class="flex items-center gap-2">
          <input type="radio" name="jawaban_benar" value="B" class="text-forest-600 focus:ring-forest-500 h-4 w-4">
          <input type="text" id="admin-opt-B" name="opsi_b" required class="flex-1 px-3 py-1.5 border border-slate-200 rounded-xl text-slate-800 text-xs focus:outline-none focus:ring-2 focus:ring-forest-500 bg-slate-50" placeholder="Pilihan B">
        </div>
        <div class="flex items-center gap-2">
          <input type="radio" name="jawaban_benar" value="C" class="text-forest-600 focus:ring-forest-500 h-4 w-4">
          <input type="text" id="admin-opt-C" name="opsi_c" required class="flex-1 px-3 py-1.5 border border-slate-200 rounded-xl text-slate-800 text-xs focus:outline-none focus:ring-2 focus:ring-forest-500 bg-slate-50" placeholder="Pilihan C">
        </div>
        <div class="flex items-center gap-2">
          <input type="radio" name="jawaban_benar" value="D" class="text-forest-600 focus:ring-forest-500 h-4 w-4">
          <input type="text" id="admin-opt-D" name="opsi_d" required class="flex-1 px-3 py-1.5 border border-slate-200 rounded-xl text-slate-800 text-xs focus:outline-none focus:ring-2 focus:ring-forest-500 bg-slate-50" placeholder="Pilihan D">
        </div>
      </div>

      <div class="flex justify-end gap-2 pt-2 border-t border-slate-100">
        <button type="button" onclick="closeQuizModal()" class="px-4 py-2 border border-slate-200 text-slate-600 font-semibold text-xs rounded-xl hover:bg-slate-50 transition-all">Batal</button>
        <button type="submit" class="px-4 py-2 bg-forest-600 hover:bg-forest-700 text-white font-semibold text-xs rounded-xl shadow-md transition-all">Simpan Soal</button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
  const adminMaterialsData = @json($materials->keyBy('id_edukasi'));

  function navigateToAdmin(page) {
    const tabs = ['dashboard', 'kelola-materi', 'kelola-kuis', 'verifikasi-laporan', 'statistik'];

    tabs.forEach(t => {
      const sec = document.getElementById(`section-admin-${t}`);
      const nav = document.getElementById(`nav-admin-${t}`);

      if (!sec || !nav) return;

      if (t === page) {
        sec.classList.remove('hidden');
        nav.className = 'px-4 py-2 rounded-lg text-sm font-semibold text-forest-700 bg-forest-50 transition-all';
      } else {
        sec.classList.add('hidden');
        nav.className = 'px-4 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:text-slate-900 transition-all';
      }
    });

    const mobileMenu = document.getElementById('admin-mobile-menu');
    if (mobileMenu) {
      mobileMenu.classList.add('hidden');
    }

    const url = new URL(window.location);
    url.searchParams.set('tab', page);
    window.history.replaceState({}, '', url);

    lucide.createIcons();
  }

  function openMaterialModal(id = null) {
    const form = document.getElementById('material-admin-form');
    form.reset();

    if (id !== null && adminMaterialsData[id]) {
      const mat = adminMaterialsData[id];
      document.getElementById('admin-mat-id').value = mat.id_edukasi;
      document.getElementById('admin-mat-title').value = mat.judul_edukasi || '';
      document.getElementById('admin-mat-category').value = mat.kategori || '';
      document.getElementById('admin-mat-content').value = mat.isi_materi || '';
      document.getElementById('modal-admin-materi-title').textContent = "Edit Materi Edukasi";
    } else {
      document.getElementById('admin-mat-id').value = '';
      document.getElementById('modal-admin-materi-title').textContent = "Tambah Materi Baru";
    }

    document.getElementById('modal-admin-materi').classList.remove('hidden');
    lucide.createIcons();
  }

  function closeMaterialFormModal() {
    document.getElementById('modal-admin-materi').classList.add('hidden');
  }

  function openQuizModal() {
    document.getElementById('quiz-admin-form').reset();
    document.getElementById('modal-admin-quiz').classList.remove('hidden');
    lucide.createIcons();
  }

  function closeQuizModal() {
    document.getElementById('modal-admin-quiz').classList.add('hidden');
  }

  document.addEventListener('DOMContentLoaded', () => {
    const initialTab = @json($activeTab);
    navigateToAdmin(initialTab || 'dashboard');
  });
</script>
@endpush
