@extends('layouts.app')
@section('title', 'Dashboard Masyarakat')

@section('content')
<div id="user-section" class="flex-1 flex flex-col">
  <!-- Navbar User -->
  <header class="bg-white border-b border-slate-100 shadow-sm sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <!-- Logo & Brand -->
        <div class="flex items-center gap-2 cursor-pointer" onclick="navigateToUser('beranda')">
          <div class="w-9 h-9 bg-forest-600 text-white rounded-lg flex items-center justify-center shadow-md">
            <i data-lucide="leaf" class="w-5 h-5"></i>
          </div>
          <span class="font-bold text-lg text-slate-800 tracking-tight">EcoLearn</span>
        </div>

        <!-- Navigation Links -->
        <nav class="hidden md:flex items-center space-x-1">
          <button onclick="navigateToUser('beranda')" id="nav-user-beranda" class="px-4 py-2 rounded-lg text-sm font-semibold text-forest-700 bg-forest-50 transition-all">Beranda</button>
          <button onclick="navigateToUser('materi')" id="nav-user-materi" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:text-slate-900 transition-all">Materi Edukasi</button>
          <button onclick="navigateToUser('kuis')" id="nav-user-kuis" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:text-slate-900 transition-all">Kuis Interaktif</button>
          <button onclick="navigateToUser('laporan')" id="nav-user-laporan" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:text-slate-900 transition-all">Laporan &amp; Feedback</button>
        </nav>

        <!-- User Info & Logout (UC-03) -->
        <div class="flex items-center gap-4">
          <div class="hidden sm:flex flex-col text-right">
            <span id="user-profile-name" class="text-sm font-semibold text-slate-800">{{ $masyarakat->nama_lengkap }}</span>
            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Masyarakat</span>
          </div>
          <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="p-2 text-slate-400 hover:text-red-500 rounded-lg hover:bg-slate-50 transition-all" title="Keluar">
              <i data-lucide="log-out" class="w-5 h-5"></i>
            </button>
          </form>
          <!-- Mobile Menu Toggle -->
          <button onclick="toggleMobileMenu('user-mobile-menu')" class="md:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-lg transition-all" aria-label="Menu">
            <i data-lucide="menu" class="w-6 h-6"></i>
          </button>
        </div>
      </div>
    </div>
    <!-- Mobile Navigation Drawer -->
    <div id="user-mobile-menu" class="hidden md:hidden border-t border-slate-100 bg-white px-4 py-2 space-y-1 shadow-inner">
      <button onclick="navigateToUser('beranda')" class="w-full text-left px-4 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 block">Beranda</button>
      <button onclick="navigateToUser('materi')" class="w-full text-left px-4 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 block">Materi Edukasi</button>
      <button onclick="navigateToUser('kuis')" class="w-full text-left px-4 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 block">Kuis Interaktif</button>
      <button onclick="navigateToUser('laporan')" class="w-full text-left px-4 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 block">Laporan &amp; Feedback</button>
    </div>
  </header>

  <!-- Main Content Area -->
  <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 transition-all">

    <!-- ========================================================================= -->
    <!-- SUBSECTION: USER BERANDA -->
    <!-- ========================================================================= -->
    <div id="section-user-beranda" class="space-y-8">
      <!-- Hero Welcome -->
      <div class="relative overflow-hidden bg-gradient-to-r from-forest-800 to-emerald-700 rounded-3xl p-8 sm:p-12 text-white shadow-xl">
        <div class="absolute -right-10 -bottom-10 opacity-10 pointer-events-none">
          <i data-lucide="leaf" class="w-80 h-80"></i>
        </div>
        <div class="relative z-10 max-w-xl">
          <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/20 text-white rounded-full text-xs font-semibold backdrop-blur-sm mb-4">
            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
            Selamat Datang Warga Peduli Lingkungan!
          </span>
          <h2 id="user-welcome-heading" class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4">Mulai Aksi Nyata Anda, {{ $masyarakat->nama_lengkap }}!</h2>
          <p class="text-forest-100 text-sm sm:text-base leading-relaxed mb-6">Dapatkan edukasi mendalam, uji pengetahuan Anda tentang kelestarian alam, serta laporkan pelanggaran atau masalah kebersihan lingkungan langsung di aplikasi EcoLearn.</p>
          <div class="flex flex-wrap gap-3">
            <button onclick="navigateToUser('materi')" class="px-5 py-2.5 bg-white text-forest-800 font-semibold rounded-xl text-sm shadow hover:bg-slate-50 transition-all flex items-center gap-2">
              <i data-lucide="book-open" class="w-4 h-4"></i> Pelajari Materi
            </button>
            <button onclick="navigateToUser('kuis')" class="px-5 py-2.5 bg-forest-900 text-white font-semibold rounded-xl text-sm border border-forest-600 hover:bg-forest-950 transition-all flex items-center gap-2">
              <i data-lucide="award" class="w-4 h-4"></i> Ikuti Kuis
            </button>
          </div>
        </div>
      </div>

      <!-- Quick Stats Grid -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
          <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
            <i data-lucide="book" class="w-6 h-6"></i>
          </div>
          <div>
            <p class="text-xs text-slate-500 font-medium">Materi Edukasi Tersedia</p>
            <h4 id="user-stats-materi" class="text-xl font-bold text-slate-800 mt-0.5">{{ $totalMateri }} Topik Utama</h4>
          </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
          <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
            <i data-lucide="check-square" class="w-6 h-6"></i>
          </div>
          <div>
            <p class="text-xs text-slate-500 font-medium">Status Kuis Anda</p>
            <h4 id="user-stats-kuis" class="text-xl font-bold text-slate-800 mt-0.5">
              @if ($skorTertinggi !== null)
                Tertinggi: {{ $skorTertinggi }} / 100
              @else
                Belum Diikuti
              @endif
            </h4>
          </div>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
          <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
            <i data-lucide="file-text" class="w-6 h-6"></i>
          </div>
          <div>
            <p class="text-xs text-slate-500 font-medium">Laporan Anda yang Dikirim</p>
            <h4 id="user-stats-laporan" class="text-xl font-bold text-slate-800 mt-0.5">{{ $totalLaporan }} Laporan</h4>
          </div>
        </div>
      </div>

      <!-- Edukasi Mini Banner -->
      <div class="bg-forest-50 rounded-2xl border border-forest-100 p-6 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="space-y-1 text-center md:text-left">
          <h3 class="font-bold text-forest-800 text-lg">Mengapa Memilah Sampah itu Penting?</h3>
          <p class="text-xs text-forest-600 max-w-xl">Memilah sampah organik dan anorganik dari rumah dapat mempermudah proses daur ulang dan mencegah pencemaran tanah dan sumber air di sekitar pemukiman.</p>
        </div>
        <button onclick="navigateToUser('materi')" class="px-5 py-2 bg-forest-600 hover:bg-forest-700 text-white font-semibold text-xs rounded-xl shadow-md transition-all shrink-0">Pelajari Selengkapnya</button>
      </div>
    </div>

    <!-- ========================================================================= -->
    <!-- SUBSECTION: USER MATERI EDUKASI (UC-04) -->
    <!-- ========================================================================= -->
    <div id="section-user-materi" class="hidden space-y-6">
      <div>
        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Katalog Materi Edukasi</h2>
        <p class="text-sm text-slate-500 mt-1">Perdalam pengetahuan Anda tentang cara mengelola dan menjaga ekosistem lingkungan sekitar.</p>
      </div>

      <!-- Cards Grid -->
      <div id="user-materials-grid" class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse ($materiList as $mat)
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 hover:shadow-md transition-all flex flex-col justify-between">
            <div class="space-y-3">
              <span class="inline-block text-[10px] uppercase font-bold text-forest-600 bg-forest-50 px-2.5 py-0.5 rounded-full">{{ $mat->kategori }}</span>
              <h3 class="font-bold text-slate-800 text-base leading-snug">{{ $mat->judul_edukasi }}</h3>
              <p class="text-xs text-slate-500 leading-relaxed">{{ Str::limit(strip_tags($mat->isi_materi), 120) }}</p>
            </div>
            <button onclick="openMaterialModalView({{ $mat->id_edukasi }})" class="mt-5 w-full py-2 bg-slate-50 hover:bg-forest-50 hover:text-forest-700 text-slate-700 font-semibold text-xs rounded-xl border border-slate-100 hover:border-forest-200 transition-all flex items-center justify-center gap-1">
              <span>Baca Selengkapnya</span>
              <i data-lucide="book-open" class="w-3.5 h-3.5"></i>
            </button>
          </div>
        @empty
          <div class="col-span-3 text-center py-12 text-slate-400 space-y-2">
            <i data-lucide="book-open" class="w-12 h-12 mx-auto text-slate-300"></i>
            <p class="text-sm font-semibold">Belum ada materi edukasi yang tersedia.</p>
          </div>
        @endforelse
      </div>
    </div>

    <!-- ========================================================================= -->
    <!-- SUBSECTION: USER KUIS INTERAKTIF (UC-05, UC-06) -->
    <!-- ========================================================================= -->
    <div id="section-user-kuis" class="hidden space-y-6">
      <div>
        <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Kuis Pengetahuan Lingkungan</h2>
        <p class="text-sm text-slate-500 mt-1">Uji seberapa dalam pemahaman Anda tentang sanitasi, pengelolaan sampah, dan kelestarian hidup.</p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Quiz Container Left (UC-05) -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sm:p-8 space-y-6">
          @if ($soalList->isEmpty())
            <div class="text-center py-12 text-slate-400 space-y-2">
              <i data-lucide="frown" class="w-12 h-12 mx-auto text-slate-300"></i>
              <p class="text-sm font-semibold">Saat ini bank soal belum tersedia.</p>
            </div>
          @else
            <form id="quiz-form" method="POST" action="{{ route('dashboard.kuis.submit') }}" class="space-y-8">
              @csrf
              <div id="quiz-question-list" class="space-y-8">
                @foreach ($soalList as $qIndex => $q)
                  <div class="space-y-4">
                    <div class="flex gap-3">
                      <span class="w-6 h-6 rounded-full bg-forest-100 text-forest-700 flex items-center justify-center text-xs font-bold shrink-0">{{ $qIndex + 1 }}</span>
                      <p class="text-sm font-semibold text-slate-800 leading-normal">{{ $q->pertanyaan }}</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pl-9">
                      <label class="flex items-center gap-3 p-3.5 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:bg-forest-50/50 hover:border-forest-200 transition-all">
                        <input type="radio" name="answers[{{ $q->id_soal }}]" value="A" required class="h-4.5 w-4.5 text-forest-600 focus:ring-forest-500 border-slate-300">
                        <span class="text-xs text-slate-700 font-medium">{{ $q->opsi_a }}</span>
                      </label>
                      <label class="flex items-center gap-3 p-3.5 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:bg-forest-50/50 hover:border-forest-200 transition-all">
                        <input type="radio" name="answers[{{ $q->id_soal }}]" value="B" required class="h-4.5 w-4.5 text-forest-600 focus:ring-forest-500 border-slate-300">
                        <span class="text-xs text-slate-700 font-medium">{{ $q->opsi_b }}</span>
                      </label>
                      <label class="flex items-center gap-3 p-3.5 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:bg-forest-50/50 hover:border-forest-200 transition-all">
                        <input type="radio" name="answers[{{ $q->id_soal }}]" value="C" required class="h-4.5 w-4.5 text-forest-600 focus:ring-forest-500 border-slate-300">
                        <span class="text-xs text-slate-700 font-medium">{{ $q->opsi_c }}</span>
                      </label>
                      <label class="flex items-center gap-3 p-3.5 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:bg-forest-50/50 hover:border-forest-200 transition-all">
                        <input type="radio" name="answers[{{ $q->id_soal }}]" value="D" required class="h-4.5 w-4.5 text-forest-600 focus:ring-forest-500 border-slate-300">
                        <span class="text-xs text-slate-700 font-medium">{{ $q->opsi_d }}</span>
                      </label>
                    </div>
                  </div>
                @endforeach
              </div>

              <hr class="border-slate-100">

              <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                <span class="text-xs text-slate-400 font-medium">* Pastikan semua pertanyaan telah dijawab dengan teliti sebelum mengirim kuis.</span>
                <button type="submit" class="px-6 py-2.5 bg-forest-600 hover:bg-forest-700 text-white font-semibold text-sm rounded-xl shadow-md transition-all active:scale-[0.98]">Submit Kuis</button>
              </div>
            </form>
          @endif
        </div>

        <!-- Quiz Results Sidebar Right (UC-06) -->
        <div class="space-y-6">
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-4">
            <h3 class="font-bold text-slate-800 text-base">Riwayat Nilai Anda</h3>
            <div id="quiz-history-container" class="space-y-3 max-h-72 overflow-y-auto custom-scrollbar">
              @forelse ($riwayatKuis as $att)
                <div class="flex justify-between items-center p-3 rounded-xl border {{ $att->status_kelulusan === 'Lulus' ? 'bg-emerald-50 border-emerald-100 text-emerald-800' : 'bg-rose-50 border-rose-100 text-rose-800' }}">
                  <div>
                    <div class="text-xs font-bold">Skor: {{ $att->skor }} / 100</div>
                    <div class="text-[9px] opacity-75">{{ $att->created_at->format('Y-m-d') }}</div>
                  </div>
                  <span class="px-2 py-0.5 rounded text-[10px] uppercase font-extrabold tracking-wider {{ $att->status_kelulusan === 'Lulus' ? 'bg-emerald-100 text-emerald-950' : 'bg-rose-100 text-rose-950' }}">
                    {{ $att->status_kelulusan }}
                  </span>
                </div>
              @empty
                <div class="text-center py-6 text-slate-400 text-xs">
                  Belum ada rekam jejak kuis Anda.
                </div>
              @endforelse
            </div>
          </div>

          <!-- Quiz Rules Box -->
          <div class="bg-gradient-to-tr from-forest-50 to-emerald-50 rounded-2xl border border-forest-100 p-6 space-y-3">
            <div class="w-10 h-10 rounded-xl bg-forest-100 text-forest-700 flex items-center justify-center">
              <i data-lucide="info" class="w-5 h-5"></i>
            </div>
            <h4 class="font-bold text-forest-900 text-sm">Ketentuan Kelulusan</h4>
            <p class="text-xs text-forest-700 leading-relaxed">Nilai minimal kelulusan adalah <strong>70</strong>. Jika Anda lulus, Anda dianggap telah menguasai kompetensi dasar pemeliharaan kebersihan lingkungan sekitar.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- ========================================================================= -->
    <!-- SUBSECTION: USER LAPORAN & FEEDBACK (UC-07, UC-08) -->
    <!-- ========================================================================= -->
    <div id="section-user-laporan" class="hidden space-y-8">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Report Form Left (UC-07) -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sm:p-8 space-y-6">
          <div>
            <h3 class="font-bold text-slate-800 text-lg flex items-center gap-2">
              <i data-lucide="alert-triangle" class="w-5 h-5 text-amber-500"></i>
              Laporan Kondisi Lingkungan
            </h3>
            <p class="text-xs text-slate-500 mt-1">Gunakan form ini untuk mengirimkan laporan kerusakan sanitasi atau tumpukan sampah liar di tempat tinggal Anda agar dapat ditinjau oleh tim verifikator.</p>
          </div>

          <form id="report-form" method="POST" action="{{ route('dashboard.laporan.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <!-- JUDUL LAPORAN -->
            <div>
              <label for="report-title" class="block text-xs font-semibold text-slate-600 mb-1.5">Judul Laporan</label>
              <input type="text" id="report-title" name="judul_laporan" value="{{ old('judul_laporan') }}" required class="w-full px-4 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50" placeholder="Judul singkat laporan">
            </div>

            <!-- NAMA PELAPOR -->
            <div>
              <label for="report-name" class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Pelapor</label>
              <input type="text" id="report-name" name="nama_pelapor" value="{{ old('nama_pelapor', $masyarakat->nama_lengkap) }}" required class="w-full px-4 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50">
            </div>

            <!-- LOKASI/ALAMAT -->
            <div>
              <label for="report-address" class="block text-xs font-semibold text-slate-600 mb-1.5">Alamat / Lokasi Kejadian</label>
              <input type="text" id="report-address" name="lokasi" value="{{ old('lokasi') }}" required class="w-full px-4 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50" placeholder="Contoh: RT 03/RW 04, Jl. Lestari">
            </div>

            <!-- KATEGORI MASALAH -->
            <div>
              <label for="report-category" class="block text-xs font-semibold text-slate-600 mb-1.5">Kategori Masalah</label>
              <select id="report-category" name="kategori" required class="w-full px-4 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50">
                <option value="">Pilih kategori...</option>
                <option value="Sampah Liar" {{ old('kategori') === 'Sampah Liar' ? 'selected' : '' }}>Sampah Liar</option>
                <option value="Saluran Tersumbat" {{ old('kategori') === 'Saluran Tersumbat' ? 'selected' : '' }}>Saluran Tersumbat</option>
                <option value="Pencemaran Air" {{ old('kategori') === 'Pencemaran Air' ? 'selected' : '' }}>Pencemaran Air</option>
                <option value="Lainnya" {{ old('kategori') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
              </select>
            </div>

            <!-- DESKRIPSI -->
            <div>
              <label for="report-condition" class="block text-xs font-semibold text-slate-600 mb-1.5">Deskripsi Kondisi Lingkungan</label>
              <textarea id="report-condition" name="deskripsi" required rows="4" class="w-full px-4 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50 custom-scrollbar" placeholder="Ceritakan detail kondisi, misalnya ada sampah menumpuk atau selokan tersumbat total...">{{ old('deskripsi') }}</textarea>
            </div>

            <!-- BUKTI/LAMPIRAN (OPSIONAL) -->
            <div>
              <label for="report-evidence" class="block text-xs font-semibold text-slate-600 mb-1.5">Bukti / Lampiran (Opsional)</label>
              <input type="file" id="report-evidence" name="bukti" class="w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-medium file:bg-forest-50 file:text-forest-700 hover:file:bg-forest-100 transition-all" accept="image/*,application/pdf">
            </div>

            <button type="submit" class="px-5 py-2.5 bg-forest-600 hover:bg-forest-700 text-white font-semibold text-sm rounded-xl shadow-md transition-all active:scale-[0.98] flex items-center justify-center gap-2">
              <i data-lucide="send" class="w-4 h-4"></i> Kirim Laporan
            </button>
          </form>
        </div>

        <!-- Feedback & Support Right (UC-08) -->
        <div class="space-y-8">
          <!-- Feedback Form -->
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sm:p-8 space-y-6">
            <div>
              <h3 class="font-bold text-slate-800 text-lg flex items-center gap-2">
                <i data-lucide="message-square" class="w-5 h-5 text-forest-600"></i>
                Feedback Aplikasi
              </h3>
              <p class="text-xs text-slate-500 mt-1">Beri saran, kritik, atau masukan untuk perbaikan dan pengembangan aplikasi EcoLearn ke depannya.</p>
            </div>

            <form id="feedback-form" method="POST" action="{{ route('dashboard.feedback.store') }}" class="space-y-4">
              @csrf
              <div>
                <label for="fb-name" class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Anda</label>
                <input type="text" id="fb-name" name="nama" value="{{ old('nama', $masyarakat->nama_lengkap) }}" required class="w-full px-4 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50">
              </div>
              <div>
                <label for="fb-msg" class="block text-xs font-semibold text-slate-600 mb-1.5">Masukan &amp; Saran</label>
                <textarea id="fb-msg" name="pesan" required rows="3" class="w-full px-4 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50 custom-scrollbar" placeholder="Ketik saran perbaikan di sini...">{{ old('pesan') }}</textarea>
              </div>
              <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-xl shadow-md transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                <i data-lucide="check" class="w-4 h-4"></i> Kirim Feedback
              </button>
            </form>
          </div>

          <!-- List Laporan Send Status -->
          <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
            <h4 class="font-bold text-slate-800 text-sm mb-4">Laporan Terbaru Anda</h4>
            <div id="user-recent-reports" class="space-y-3 max-h-56 overflow-y-auto pr-1 custom-scrollbar">
              @forelse ($laporanUser as $r)
                <div class="p-3 bg-slate-50 border border-slate-100 rounded-xl space-y-1.5">
                  <div class="flex justify-between items-center">
                    <span class="text-[10px] text-slate-400">{{ $r->created_at ? $r->created_at->format('Y-m-d') : date('Y-m-d') }}</span>
                    @if ($r->status_verifikasi === 'menunggu')
                      <span class="bg-amber-100 text-amber-800 text-[9px] px-2 py-0.5 rounded font-semibold uppercase tracking-wider">Menunggu</span>
                    @elseif ($r->status_verifikasi === 'terverifikasi')
                      <span class="bg-emerald-100 text-emerald-800 text-[9px] px-2 py-0.5 rounded font-semibold uppercase tracking-wider">Terverifikasi</span>
                    @else
                      <span class="bg-red-100 text-red-800 text-[9px] px-2 py-0.5 rounded font-semibold uppercase tracking-wider">Ditolak</span>
                    @endif
                  </div>
                  <h5 class="text-xs font-bold text-slate-800 truncate">{{ $r->judul_laporan }}</h5>
                  <p class="text-xs font-normal text-slate-600 truncate">{{ $r->deskripsi }}</p>
                  <div class="text-[10px] text-slate-400 truncate flex items-center gap-1">
                    <i data-lucide="map-pin" class="w-3 h-3"></i> {{ $r->lokasi }}
                  </div>
                </div>
              @empty
                <p class="text-xs text-slate-400 text-center py-4">Belum ada laporan dari Anda.</p>
              @endforelse
            </div>
          </div>
        </div>

      </div>
    </div>

  </main>
</div>

<!-- ========================================================================= -->
<!-- [MODAL A] USER ACCESS EDUKASI POPUP (UC-04) -->
<!-- ========================================================================= -->
<div id="modal-view-materi" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-full max-h-[85vh] flex flex-col overflow-hidden border border-slate-100 animate-slideIn">
    <!-- Modal Header -->
    <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-forest-50">
      <div>
        <span id="modal-materi-category" class="text-[10px] uppercase font-bold text-forest-600 tracking-wider bg-forest-100 px-2.5 py-0.5 rounded-full">Kategori</span>
        <h3 id="modal-materi-title" class="font-bold text-slate-800 text-lg mt-2">Judul Materi</h3>
      </div>
      <button onclick="closeMaterialModalView()" class="p-1 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-all" aria-label="Tutup">
        <i data-lucide="x" class="w-6 h-6"></i>
      </button>
    </div>
    <!-- Modal Content Body -->
    <div class="p-6 overflow-y-auto space-y-4 text-sm text-slate-600 leading-relaxed custom-scrollbar" id="modal-materi-content">
      <!-- Dynamic content -->
    </div>
    <!-- Modal Footer -->
    <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end">
      <button onclick="closeMaterialModalView()" class="px-5 py-2 bg-forest-600 hover:bg-forest-700 text-white font-semibold text-xs rounded-xl shadow-md transition-all">Selesai Membaca</button>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  // Materi data store for interactive popup
  const materialsData = @json($materiList->keyBy('id_edukasi'));

  function navigateToUser(page) {
    const tabs = ['beranda', 'materi', 'kuis', 'laporan'];

    tabs.forEach(t => {
      const sec = document.getElementById(`section-user-${t}`);
      const nav = document.getElementById(`nav-user-${t}`);

      if (!sec || !nav) return;

      if (t === page) {
        sec.classList.remove('hidden');
        nav.className = 'px-4 py-2 rounded-lg text-sm font-semibold text-forest-700 bg-forest-50 transition-all';
      } else {
        sec.classList.add('hidden');
        nav.className = 'px-4 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:text-slate-900 transition-all';
      }
    });

    const mobileMenu = document.getElementById('user-mobile-menu');
    if (mobileMenu) {
      mobileMenu.classList.add('hidden');
    }

    // Update URL query string without reloading page
    const url = new URL(window.location);
    url.searchParams.set('tab', page);
    window.history.replaceState({}, '', url);

    lucide.createIcons();
  }

  function openMaterialModalView(id) {
    const mat = materialsData[id];
    if (!mat) return;

    document.getElementById('modal-materi-category').textContent = mat.kategori || 'Edukasi';
    document.getElementById('modal-materi-title').textContent = mat.judul_edukasi || '';

    const body = document.getElementById('modal-materi-content');
    const content = mat.isi_materi || '';
    body.innerHTML = content.split('\n\n').map(p => `<p class="mb-3">${p.replace(/\n/g, '<br>')}</p>`).join('');

    document.getElementById('modal-view-materi').classList.remove('hidden');
    lucide.createIcons();
  }

  function closeMaterialModalView() {
    document.getElementById('modal-view-materi').classList.add('hidden');
  }

  document.addEventListener('DOMContentLoaded', () => {
    // Open initial tab from server or URL query
    const initialTab = @json($activeTab);
    navigateToUser(initialTab || 'beranda');
  });
</script>
@endpush
