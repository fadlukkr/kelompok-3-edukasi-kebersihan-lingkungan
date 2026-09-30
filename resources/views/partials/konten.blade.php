  <!-- ========================================================================= -->
  <!-- [1] AUTENTIKASI: LOGIN & REGISTRASI (UC-01, UC-02) -->
  <!-- Sesuai SKPL KNF-08: autentikasi berbasis email dan kata sandi terenkripsi -->
  <!-- Sesuai DPPL UI: halaman Login menggunakan txtEmail dan txtPassword -->
  <!-- Sesuai DPPL UI: halaman Registrasi menggunakan txtNama, txtEmail, txtPassword, txtConfirmPassword -->
  <!-- ========================================================================= -->
  <section id="auth-section" class="flex-1 flex items-center justify-center p-4 bg-gradient-to-br from-forest-50 via-slate-50 to-emerald-50">
    <div class="w-full max-w-md bg-white/80 backdrop-blur-md rounded-2xl shadow-xl border border-slate-100 p-8 transition-all duration-300">
      
      <!-- Logo Brand -->
      <div class="flex flex-col items-center mb-8">
        <div class="w-14 h-14 bg-forest-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-forest-200 mb-3">
          <i data-lucide="leaf" class="w-8 h-8"></i>
        </div>
        <h1 class="text-2xl font-bold text-slate-800 tracking-tight">EcoLearn</h1>
        <p class="text-xs text-slate-500 mt-1">Edukasi & Aksi Kebersihan Lingkungan</p>
      </div>

      <!-- Tab Switcher (UC-01) -->
      <div class="flex bg-slate-100 p-1 rounded-xl mb-6">
        <button id="tab-login" onclick="switchAuthTab('login')" class="flex-1 py-2 text-sm font-medium rounded-lg text-slate-800 bg-white shadow-sm transition-all duration-200">
          Login
        </button>
        <button id="tab-register" onclick="switchAuthTab('register')" class="flex-1 py-2 text-sm font-medium rounded-lg text-slate-500 hover:text-slate-800 transition-all duration-200">
          Registrasi
        </button>
      </div>

      <!-- Error Alert -->
      <div id="auth-error-alert" class="hidden mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded text-red-700 text-sm flex items-center gap-2">
        <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
        <span id="auth-error-msg">Email atau password salah!</span>
      </div>

      <!-- LOGIN FORM (UC-02, KNF-08: email + password) -->
      <!-- Sesuai DPPL UI halaman Login: txtEmail, txtPassword -->
      <form id="login-form" onsubmit="handleLogin(event)" class="space-y-4">
        <div>
          <label for="login-email" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">Email</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
              <i data-lucide="mail" class="w-4.5 h-4.5"></i>
            </span>
            <input type="email" id="login-email" required autocomplete="email" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all" placeholder="masukkan@email.com">
          </div>
        </div>
        <div>
          <label for="login-password" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">Password</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
              <i data-lucide="lock" class="w-4.5 h-4.5"></i>
            </span>
            <input type="password" id="login-password" required autocomplete="current-password" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all" placeholder="••••••••">
          </div>
        </div>
        <button type="submit" class="w-full py-3 bg-forest-600 hover:bg-forest-700 active:scale-[0.99] text-white font-semibold rounded-xl shadow-lg shadow-forest-100 hover:shadow-forest-200 transition-all flex items-center justify-center gap-2">
          <span>Masuk</span>
          <i data-lucide="arrow-right" class="w-4.5 h-4.5"></i>
        </button>
      </form>

      <!-- REGISTER FORM (UC-01) -->
      <!-- Sesuai DPPL UI halaman Registrasi: txtNama, txtEmail, txtPassword, txtConfirmPassword -->
      <!-- Password minimal 8 karakter sesuai DPPL UI: "minimal 8 karakter" -->
      <form id="register-form" onsubmit="handleRegister(event)" class="space-y-4 hidden">
        <div>
          <label for="reg-name" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">Nama Lengkap</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
              <i data-lucide="tag" class="w-4.5 h-4.5"></i>
            </span>
            <input type="text" id="reg-name" required class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all" placeholder="Nama Lengkap Anda">
          </div>
        </div>
        <div>
          <label for="reg-email" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">Email</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
              <i data-lucide="mail" class="w-4.5 h-4.5"></i>
            </span>
            <input type="email" id="reg-email" required autocomplete="email" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all" placeholder="email@contoh.com">
          </div>
        </div>
        <div>
          <label for="reg-password" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">Password</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
              <i data-lucide="lock" class="w-4.5 h-4.5"></i>
            </span>
            <input type="password" id="reg-password" required autocomplete="new-password" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all" placeholder="Min. 8 karakter">
          </div>
        </div>
        <div>
          <label for="reg-confirm-password" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">Konfirmasi Password</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
              <i data-lucide="lock" class="w-4.5 h-4.5"></i>
            </span>
            <input type="password" id="reg-confirm-password" required autocomplete="new-password" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all" placeholder="Ulangi password">
          </div>
        </div>
        <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 active:scale-[0.99] text-white font-semibold rounded-xl shadow-lg shadow-emerald-100 hover:shadow-emerald-200 transition-all flex items-center justify-center gap-2">
          <span>Daftar Sekarang</span>
          <i data-lucide="user-plus" class="w-4.5 h-4.5"></i>
        </button>
      </form>

    </div>
  </section>

  <!-- ========================================================================= -->
  <!-- [2] DASHBOARD MASYARAKAT / USER (UC-04 s/d UC-08) -->
  <!-- ========================================================================= -->
  <div id="user-section" class="hidden flex-1 flex flex-col">
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
            <button onclick="navigateToUser('laporan')" id="nav-user-laporan" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:text-slate-900 transition-all">Laporan & Feedback</button>
          </nav>

          <!-- User Info & Logout (UC-03) -->
          <div class="flex items-center gap-4">
            <div class="hidden sm:flex flex-col text-right">
              <span id="user-profile-name" class="text-sm font-semibold text-slate-800">Nama Warga</span>
              <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Masyarakat</span>
            </div>
            <button onclick="handleLogout()" class="p-2 text-slate-400 hover:text-red-500 rounded-lg hover:bg-slate-50 transition-all" title="Keluar">
              <i data-lucide="log-out" class="w-5 h-5"></i>
            </button>
            <!-- Mobile Menu Toggle -->
            <button onclick="toggleMobileMenu('user-mobile-menu')" class="md:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-lg transition-all">
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
        <button onclick="navigateToUser('laporan')" class="w-full text-left px-4 py-2 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 block">Laporan & Feedback</button>
      </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 transition-all">
      
      <!-- SUBSECTION: USER BERANDA -->
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
            <h2 id="user-welcome-heading" class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4">Mulai Aksi Nyata Anda untuk Lingkungan yang Bersih</h2>
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
              <h4 id="user-stats-materi" class="text-xl font-bold text-slate-800 mt-0.5">3 Topik Utama</h4>
            </div>
          </div>
          <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
              <i data-lucide="check-square" class="w-6 h-6"></i>
            </div>
            <div>
              <p class="text-xs text-slate-500 font-medium">Status Kuis Anda</p>
              <h4 id="user-stats-kuis" class="text-xl font-bold text-slate-800 mt-0.5">Belum Diikuti</h4>
            </div>
          </div>
          <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
              <i data-lucide="file-text" class="w-6 h-6"></i>
            </div>
            <div>
              <p class="text-xs text-slate-500 font-medium">Laporan Anda yang Dikirim</p>
              <h4 id="user-stats-laporan" class="text-xl font-bold text-slate-800 mt-0.5">0 Laporan</h4>
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

      <!-- SUBSECTION: USER MATERI EDUKASI (UC-04) -->
      <div id="section-user-materi" class="hidden space-y-6">
        <div>
          <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Katalog Materi Edukasi</h2>
          <p class="text-sm text-slate-500 mt-1">Perdalam pengetahuan Anda tentang cara mengelola dan menjaga ekosistem lingkungan sekitar.</p>
        </div>
        
        <!-- Cards Grid -->
        <div id="user-materials-grid" class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <!-- Dynamic Content Loaded via JS -->
        </div>
      </div>

      <!-- SUBSECTION: USER KUIS INTERAKTIF (UC-05, UC-06) -->
      <div id="section-user-kuis" class="hidden space-y-6">
        <div>
          <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Kuis Pengetahuan Lingkungan</h2>
          <p class="text-sm text-slate-500 mt-1">Uji seberapa dalam pemahaman Anda tentang sanitasi, pengelolaan sampah, dan kelestarian hidup.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <!-- Quiz Container Left (UC-05) -->
          <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 shadow-sm p-6 sm:p-8 space-y-6">
            <div id="quiz-question-list" class="space-y-8">
              <!-- Dynamic quiz questions load here -->
            </div>
            
            <hr class="border-slate-100">
            
            <div class="flex justify-between items-center">
              <span class="text-xs text-slate-400 font-medium">* Pastikan semua pertanyaan telah dijawab dengan teliti sebelum mengirim kuis.</span>
              <button onclick="submitQuiz()" class="px-6 py-2.5 bg-forest-600 hover:bg-forest-700 text-white font-semibold text-sm rounded-xl shadow-md transition-all active:scale-[0.98]">Submit Kuis</button>
            </div>
          </div>

          <!-- Quiz Results Sidebar Right (UC-06) -->
          <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-4">
              <h3 class="font-bold text-slate-800 text-base">Riwayat Nilai Anda</h3>
              <div id="quiz-history-container" class="space-y-3">
                <!-- Dynamic values or empty states -->
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

      <!-- SUBSECTION: USER LAPORAN & FEEDBACK (UC-07, UC-08) -->
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

            <form id="report-form" onsubmit="submitReport(event)" class="space-y-4">
              <!-- JUDUL LAPORAN - Ditambahkan sesuai DPPL UI: txtJudul -->
              <div>
                <label for="report-title" class="block text-xs font-semibold text-slate-600 mb-1.5">Judul Laporan</label>
                <input type="text" id="report-title" required class="w-full px-4 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50" placeholder="Judul singkat laporan">
              </div>

              <!-- NAMA PELAPOR - Sesuai DPPL UI: txtNamalaporan -->
              <div>
                <label for="report-name" class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Pelapor</label>
                <input type="text" id="report-name" required class="w-full px-4 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50">
              </div>

              <!-- LOKASI/ALAMAT - Sesuai DPPL UI: txtLokasi (Alamat) -->
              <div>
                <label for="report-address" class="block text-xs font-semibold text-slate-600 mb-1.5">Alamat / Lokasi Kejadian</label>
                <input type="text" id="report-address" required class="w-full px-4 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50" placeholder="Contoh: RT 03/RW 04, Jl. Lestari">
              </div>

              <!-- KATEGORI MASALAH - Ditambahkan sesuai DPPL UI: ddlKategori -->
              <!-- Kategori: Sampah Liar, Saluran Tersumbat, Pencemaran Air, Lainnya -->
              <div>
                <label for="report-category" class="block text-xs font-semibold text-slate-600 mb-1.5">Kategori Masalah</label>
                <select id="report-category" required class="w-full px-4 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50">
                  <option value="">Pilih kategori...</option>
                  <option value="Sampah Liar">Sampah Liar</option>
                  <option value="Saluran Tersumbat">Saluran Tersumbat</option>
                  <option value="Pencemaran Air">Pencemaran Air</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
              </div>

              <!-- DESKRIPSI - Sesuai DPPL UI: rtfDeskripsi -->
              <div>
                <label for="report-condition" class="block text-xs font-semibold text-slate-600 mb-1.5">Deskripsi Kondisi Lingkungan</label>
                <textarea id="report-condition" required rows="4" class="w-full px-4 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50 custom-scrollbar" placeholder="Ceritakan detail kondisi, misalnya ada sampah menumpuk atau selokan tersumbat total..."></textarea>
              </div>

              <!-- BUKTI/LAMPIRAN - Opsional, sesuai UC Kirim Laporan: "mengunggah bukti pendukung jika diperlukan" -->
              <div>
                <label for="report-evidence" class="block text-xs font-semibold text-slate-600 mb-1.5">Bukti / Lampiran (Opsional)</label>
                <input type="file" id="report-evidence" class="w-full text-xs text-slate-500 file:mr-4 file:py-1.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-medium file:bg-forest-50 file:text-forest-700 hover:file:bg-forest-100 transition-all" accept="image/*,application/pdf">
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

              <form id="feedback-form" onsubmit="submitFeedback(event)" class="space-y-4">
                <div>
                  <label for="fb-name" class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Anda</label>
                  <input type="text" id="fb-name" required class="w-full px-4 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50">
                </div>
                <div>
                  <label for="fb-msg" class="block text-xs font-semibold text-slate-600 mb-1.5">Masukan & Saran</label>
                  <textarea id="fb-msg" required rows="3" class="w-full px-4 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50 custom-scrollbar" placeholder="Ketik saran perbaikan di sini..."></textarea>
                </div>
                <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-sm rounded-xl shadow-md transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                  <i data-lucide="check" class="w-4 h-4"></i> Kirim Feedback
                </button>
              </form>
            </div>

            <!-- List Laporan Send Status -->
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6">
              <h4 class="font-bold text-slate-800 text-sm mb-4">Laporan Terbaru Anda</h4>
              <div id="user-recent-reports" class="space-y-3 max-h-48 overflow-y-auto pr-1 custom-scrollbar">
                <!-- Loaded Dynamically -->
              </div>
            </div>
          </div>

        </div>
      </div>

    </main>
  </div>

  <!-- ========================================================================= -->
  <!-- [3] DASHBOARD MAHASISWA / ADMIN (UC-09 s/d UC-12) -->
  <!-- ========================================================================= -->
  <div id="admin-section" class="hidden flex-1 flex flex-col">
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
              <span id="admin-profile-name" class="text-sm font-semibold text-slate-800">Admin</span>
              <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Mahasiswa / Admin</span>
            </div>
            <button onclick="handleLogout()" class="p-2 text-slate-400 hover:text-red-500 rounded-lg hover:bg-slate-50 transition-all" title="Keluar">
              <i data-lucide="log-out" class="w-5 h-5"></i>
            </button>
            <!-- Mobile Menu Toggle -->
            <button onclick="toggleMobileMenu('admin-mobile-menu')" class="md:hidden p-2 text-slate-600 hover:bg-slate-100 rounded-lg transition-all">
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

      <!-- SUBSECTION: ADMIN DASHBOARD (UC-12 STATISTIK OVERVIEW) -->
      <div id="section-admin-dashboard" class="space-y-8">
        <div>
          <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Selamat Datang di Panel Control Admin</h2>
          <p class="text-sm text-slate-500 mt-1">Anda memiliki akses penuh untuk mengelola materi, bank soal kuis, serta memverifikasi pengaduan warga.</p>
        </div>

        <!-- STATISTIK CARDS (UC-12) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" id="admin-stats-container">
          <!-- Rendered Dynamically -->
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
                  <!-- Dynamic Rows -->
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
                    <th class="p-3">Username</th>
                    <th class="p-3">Skor</th>
                    <th class="p-3">Kelulusan</th>
                    <th class="p-3">Tanggal</th>
                  </tr>
                </thead>
                <tbody id="admin-dash-quizzes" class="divide-y divide-slate-100">
                  <!-- Dynamic Rows -->
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>

      <!-- SUBSECTION: ADMIN KELOLA EDUKASI (UC-09) -->
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
                <!-- Dynamic Content Load -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- SUBSECTION: ADMIN KELOLA KUIS (UC-10) -->
      <div id="section-admin-kelola-kuis" class="hidden space-y-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Kelola Soal & Kuis</h2>
            <p class="text-sm text-slate-500 mt-1">Lihat koleksi bank soal kuis atau tambahkan pertanyaan baru secara real-time.</p>
          </div>
          <button onclick="openQuizModal()" class="px-4 py-2 bg-forest-600 hover:bg-forest-700 text-white font-semibold text-xs rounded-xl shadow-md transition-all flex items-center gap-1.5 self-start">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Soal Baru
          </button>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-6 space-y-4" id="admin-quiz-list">
          <!-- Loaded dynamically -->
        </div>
      </div>

      <!-- SUBSECTION: ADMIN VERIFIKASI LAPORAN (UC-11) -->
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
                  <th class="p-4">Status</th>
                  <th class="p-4 text-center">Aksi Verifikasi</th>
                </tr>
              </thead>
              <tbody id="admin-verification-table" class="divide-y divide-slate-100 text-xs">
                <!-- Dynamically loaded -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- SUBSECTION: ADMIN STATISTIK DETAIL (UC-12) -->
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
              <!-- Pending bar simulator -->
              <div>
                <div class="flex justify-between text-xs font-medium text-slate-600 mb-1.5">
                  <span>Laporan Menunggu (Pending)</span>
                  <span id="stat-bar-pending-txt">0%</span>
                </div>
                <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                  <div id="stat-bar-pending" class="h-full bg-amber-500 transition-all duration-500" style="width: 0%"></div>
                </div>
              </div>

              <!-- Verified bar simulator -->
              <div>
                <div class="flex justify-between text-xs font-medium text-slate-600 mb-1.5">
                  <span>Laporan Terverifikasi</span>
                  <span id="stat-bar-verified-txt">0%</span>
                </div>
                <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                  <div id="stat-bar-verified" class="h-full bg-emerald-500 transition-all duration-500" style="width: 0%"></div>
                </div>
              </div>

              <!-- Rejected bar simulator -->
              <div>
                <div class="flex justify-between text-xs font-medium text-slate-600 mb-1.5">
                  <span>Laporan Ditolak</span>
                  <span id="stat-bar-rejected-txt">0%</span>
                </div>
                <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
                  <div id="stat-bar-rejected" class="h-full bg-red-500 transition-all duration-500" style="width: 0%"></div>
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
                <h4 id="stat-avg-score" class="text-3xl font-extrabold text-forest-700 mt-1">0</h4>
              </div>
              <div class="bg-slate-50 p-4 rounded-xl text-center">
                <p class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Tingkat Kelulusan</p>
                <h4 id="stat-pass-rate" class="text-3xl font-extrabold text-emerald-600 mt-1">0%</h4>
              </div>
            </div>
            <div class="border-t border-slate-100 pt-4 flex items-center justify-between text-xs text-slate-500">
              <span>Total Ujian Diselesaikan:</span>
              <span id="stat-total-exams" class="font-bold text-slate-800">0 Kali</span>
            </div>
          </div>

        </div>
      </div>

    </main>
  </div>

  <!-- ========================================================================= -->
  <!-- MODAL WINDOWS -->
  <!-- ========================================================================= -->
  
  <!-- [MODAL A] USER ACCESS EDUKASI POPUP (UC-04) -->
  <div id="modal-view-materi" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl max-w-2xl w-full max-h-[85vh] flex flex-col overflow-hidden border border-slate-100 animate-slideIn">
      <!-- Modal Header -->
      <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-forest-50">
        <div>
          <span id="modal-materi-category" class="text-[10px] uppercase font-bold text-forest-600 tracking-wider bg-forest-100 px-2.5 py-0.5 rounded-full">Kategori</span>
          <h3 id="modal-materi-title" class="font-bold text-slate-800 text-lg mt-2">Judul Materi</h3>
        </div>
        <button onclick="closeMaterialModalView()" class="p-1 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-all">
          <i data-lucide="x" class="w-6 h-6"></i>
        </button>
      </div>
      <!-- Modal Content Body -->
      <div class="p-6 overflow-y-auto space-y-4 text-sm text-slate-600 leading-relaxed custom-scrollbar" id="modal-materi-content">
        <!-- Content text with breaks -->
      </div>
      <!-- Modal Footer -->
      <div class="p-4 border-t border-slate-100 bg-slate-50 flex justify-end">
        <button onclick="closeMaterialModalView()" class="px-5 py-2 bg-forest-600 hover:bg-forest-700 text-white font-semibold text-xs rounded-xl shadow-md transition-all">Selesai Membaca</button>
      </div>
    </div>
  </div>

  <!-- [MODAL B] ADMIN ADD/EDIT MATERI FORM (UC-09) -->
  <div id="modal-admin-materi" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full overflow-hidden border border-slate-100">
      <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50">
        <h3 id="modal-admin-materi-title" class="font-bold text-slate-800 text-base">Kelola Materi Edukasi</h3>
        <button onclick="closeMaterialFormModal()" class="p-1 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-all">
          <i data-lucide="x" class="w-6 h-6"></i>
        </button>
      </div>
      <form id="material-admin-form" onsubmit="saveMaterial(event)" class="p-6 space-y-4">
        <input type="hidden" id="admin-mat-id">
        <div>
          <label for="admin-mat-title" class="block text-xs font-semibold text-slate-600 mb-1.5">Judul Materi</label>
          <input type="text" id="admin-mat-title" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50">
        </div>
        <div>
          <label for="admin-mat-category" class="block text-xs font-semibold text-slate-600 mb-1.5">Kategori</label>
          <input type="text" id="admin-mat-category" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50" placeholder="Misal: Daur Ulang, Sanitasi, dll.">
        </div>
        <div>
          <label for="admin-mat-short" class="block text-xs font-semibold text-slate-600 mb-1.5">Ringkasan Singkat</label>
          <input type="text" id="admin-mat-short" required class="w-full px-3 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50" placeholder="Ringkasan di card halaman depan">
        </div>
        <div>
          <label for="admin-mat-content" class="block text-xs font-semibold text-slate-600 mb-1.5">Konten Detail Materi</label>
          <textarea id="admin-mat-content" required rows="6" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50 custom-scrollbar" placeholder="Isi materi edukasi secara mendalam..."></textarea>
        </div>
        <div class="flex justify-end gap-2 pt-2 border-t border-slate-100">
          <button type="button" onclick="closeMaterialFormModal()" class="px-4 py-2 border border-slate-200 text-slate-600 font-semibold text-xs rounded-xl hover:bg-slate-50 transition-all">Batal</button>
          <button type="submit" class="px-4 py-2 bg-forest-600 hover:bg-forest-700 text-white font-semibold text-xs rounded-xl shadow-md transition-all">Simpan Konten</button>
        </div>
      </form>
    </div>
  </div>

  <!-- [MODAL C] ADMIN ADD SOAL FORM (UC-10) -->
  <div id="modal-admin-quiz" class="hidden fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl max-w-lg w-full overflow-hidden border border-slate-100">
      <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-slate-50">
        <h3 class="font-bold text-slate-800 text-base">Tambah Soal Baru</h3>
        <button onclick="closeQuizModal()" class="p-1 rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-all">
          <i data-lucide="x" class="w-6 h-6"></i>
        </button>
      </div>
      <form id="quiz-admin-form" onsubmit="saveQuizQuestion(event)" class="p-6 space-y-4">
        <div>
          <label for="admin-q-text" class="block text-xs font-semibold text-slate-600 mb-1.5">Pertanyaan</label>
          <textarea id="admin-q-text" required rows="2.5" class="w-full px-3 py-2 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all bg-slate-50" placeholder="Ketik soal kuis..."></textarea>
        </div>
        <div class="space-y-3">
          <span class="block text-xs font-semibold text-slate-600">Pilihan Jawaban (Berikan Tanda Centang untuk Jawaban Benar)</span>
          
          <div class="flex items-center gap-2">
            <input type="radio" name="correct-opt" value="0" required class="text-forest-600 focus:ring-forest-500 h-4 w-4">
            <input type="text" id="admin-opt-0" required class="flex-1 px-3 py-1.5 border border-slate-200 rounded-xl text-slate-800 text-xs focus:outline-none focus:ring-2 focus:ring-forest-500 bg-slate-50" placeholder="Pilihan A">
          </div>
          <div class="flex items-center gap-2">
            <input type="radio" name="correct-opt" value="1" class="text-forest-600 focus:ring-forest-500 h-4 w-4">
            <input type="text" id="admin-opt-1" required class="flex-1 px-3 py-1.5 border border-slate-200 rounded-xl text-slate-800 text-xs focus:outline-none focus:ring-2 focus:ring-forest-500 bg-slate-50" placeholder="Pilihan B">
          </div>
          <div class="flex items-center gap-2">
            <input type="radio" name="correct-opt" value="2" class="text-forest-600 focus:ring-forest-500 h-4 w-4">
            <input type="text" id="admin-opt-2" required class="flex-1 px-3 py-1.5 border border-slate-200 rounded-xl text-slate-800 text-xs focus:outline-none focus:ring-2 focus:ring-forest-500 bg-slate-50" placeholder="Pilihan C">
          </div>
          <div class="flex items-center gap-2">
            <input type="radio" name="correct-opt" value="3" class="text-forest-600 focus:ring-forest-500 h-4 w-4">
            <input type="text" id="admin-opt-3" required class="flex-1 px-3 py-1.5 border border-slate-200 rounded-xl text-slate-800 text-xs focus:outline-none focus:ring-2 focus:ring-forest-500 bg-slate-50" placeholder="Pilihan D">
          </div>
        </div>

        <div class="flex justify-end gap-2 pt-2 border-t border-slate-100">
          <button type="button" onclick="closeQuizModal()" class="px-4 py-2 border border-slate-200 text-slate-600 font-semibold text-xs rounded-xl hover:bg-slate-50 transition-all">Batal</button>
          <button type="submit" class="px-4 py-2 bg-forest-600 hover:bg-forest-700 text-white font-semibold text-xs rounded-xl shadow-md transition-all">Simpan Soal</button>
        </div>
      </form>
    </div>
  </div>

