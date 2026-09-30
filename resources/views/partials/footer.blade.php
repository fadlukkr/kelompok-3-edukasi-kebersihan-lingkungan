  <!-- Footer Website -->
  <footer class="bg-slate-900 border-t border-slate-800 py-6 text-center text-slate-500 text-xs mt-auto">
    <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
      <div class="flex items-center gap-2">
        <div class="w-6 h-6 bg-forest-600 text-white rounded-md flex items-center justify-center">
          <i data-lucide="leaf" class="w-3.5 h-3.5"></i>
        </div>
        <span class="font-bold text-sm text-slate-300">EcoLearn</span>
      </div>
      <p>&copy; 2026 EcoLearn Platform. Kelestarian bumi di tangan kita bersama.</p>
    </div>
  </footer>

  <!-- ========================================================================= -->
  <!-- MAIN CONTROLLER STATE & DOM ACTIONS -->
  <!-- ========================================================================= -->
  <script>
    /* ============================================================================
     * DATA SIMULASI (DUMMY DATA)
     * 
     * SEMUA DATA DI BAWAH INI ADALAH DATA SIMULASI/HARDCODE UNTUK DEBUGGING FRONTEND.
     * SAAT INTEGRASI DENGAN BACKEND PHP, DATA INI AKAN DIGANTI DENGAN RESPONSE DARI
     * TABEL-TABEL DATABASE `ecolearn`:
     *   - users         → tabel `masyarakat` + `admin`
     *   - materials     → tabel `edukasi`
     *   - quizQuestions → tabel `kuis` + `soal`
     *   - reports       → tabel `laporan`
     *   - quizResults   → tabel `jawaban`
     *   - feedbacks     → tabel `feedback`
     * 
     * Password yang ada di sini HANYA untuk simulasi frontend.
     * Password sebenarnya TIDAK akan disimpan di JavaScript — akan dilewatkan ke
     * backend dan di-hash di sana (bcrypt/argon2 sesuai SKPL KNF-08).
     * ============================================================================ */

    // ============================================================================
    // DATA MOCK: Pengguna (USER SIMULASI)
    // Nanti diganti dengan response dari tabel `masyarakat` dan `admin`
    // SAAT INTEGRASI: login berdasarkan email (bukan username)
    // ============================================================================
    let users = [
      { id: 1, email: 'admin@ecolearn.ac.id', password: 'admin123', role: 'admin', name: 'Administrator' },
      { id: 2, email: 'budisantoso@email.com', password: 'user123', role: 'user', name: 'Budi Santoso' }
    ];

    // ============================================================================
    // DATA MOCK: Materi Edukasi (UI STATIC / SIMULASI)
    // Nanti diganti dengan response dari tabel `edukasi`
    // Struktur kompatibel: id, title, category, shortDesc, content
    // (Kategori adalah metadata UI; tabel edukasi tidak memiliki kolom kategori)
    // ============================================================================
    let materials = [
      {
        id: 1,
        title: 'Jenis Sampah Organik & Anorganik',
        category: 'Pengenalan Sampah',
        shortDesc: 'Pelajari perbedaan mendasar sampah organik dan anorganik serta cara memilahnya.',
        content: 'Sampah Organik adalah sampah yang berasal dari sisa makhluk hidup yang mudah membusuk secara alami tanpa proses campur tangan manusia untuk dapat terurai. Contohnya: sisa makanan, daun kering, sayuran, dan buah-buahan. Sampah ini bisa diolah menjadi pupuk kompos.\n\nSampah Anorganik adalah sampah yang dihasilkan dari bahan-bahan non-hayati, baik berupa produk sintetik maupun hasil proses teknologi pengolahan bahan tambang. Contohnya: botol plastik, kantong plastik, kaleng, kaca, dan kertas. Sampah ini membutuhkan waktu ratusan tahun untuk terurai secara alami, sehingga daur ulang adalah solusi terbaik.'
      },
      {
        id: 2,
        title: 'Prinsip 3R (Reduce, Reuse, Recycle)',
        category: 'Daur Ulang',
        shortDesc: 'Panduan praktis mengaplikasikan gaya hidup 3R untuk mengurangi tumpukan sampah harian.',
        content: 'Prinsip 3R merupakan langkah utama dalam pengelolaan sampah berkelanjutan:\n\n1. Reduce (Mengurangi): Meminimalisir produksi sampah sejak awal. Contoh: membawa kantong belanja sendiri, mengurangi penggunaan plastik sekali pakai.\n2. Reuse (Menggunakan Kembali): Memanfaatkan kembali barang-barang bekas tanpa membuangnya terlebih dahulu. Contoh: menggunakan botol minum isi ulang, memakai wadah bekas untuk pot tanaman.\n3. Recycle (Mendaur Ulang): Mengolah kembali sampah menjadi produk baru yang bermanfaat. Contoh: membuat kerajinan dari sedotan, mengirim botol plastik ke bank sampah untuk dicacah menjadi bijih plastik.'
      },
      {
        id: 3,
        title: 'Sanitasi Air Bersih & Higienitas',
        category: 'Kesehatan Lingkungan',
        shortDesc: 'Pentingnya menjaga kebersihan sumber air dan sanitasi untuk mencegah penyebaran penyakit.',
        content: 'Sanitasi air bersih adalah upaya menjaga kebersihan air dari berbagai pencemaran seperti limbah industri, limbah domestik, dan bakteri e-coli. Air bersih adalah hak dasar dan kebutuhan vital bagi kehidupan manusia.\n\nCara menjaga sanitasi air:\n- Membuat sumur resapan dan menjaga jarak septic tank minimal 10 meter dari sumber air.\n- Tidak membuang sampah atau limbah detergen langsung ke sungai atau parit.\n- Melakukan penyaringan sederhana dan memasak air hingga mendidih sebelum dikonsumsi.\n\nSanitasi yang buruk dapat memicu wabah penyakit diare, kolera, dan stunting pada anak-anak.'
      }
    ];

    // ============================================================================
    // DATA MOCK: Soal Kuis (UI STATIC / SIMULASI)
    // Nanti diganti dengan response gabungan dari tabel `kuis` dan `soal`
    // Format kompatibel dengan tampilan UI: options berupa array string [A,B,C,D]
    // Database menggunakan ENUM 'A','B','C','D' untuk jawaban_benar
    // ============================================================================
    let quizQuestions = [
      {
        id: 1,
        question: 'Manakah dari berikut ini yang termasuk ke dalam sampah organik?',
        options: ['Botol kaca', 'Sisa sayuran dan buah', 'Kaleng minuman', 'Kantong plastik sekali pakai'],
        answer: 1  // index opsi yang benar (0=A, 1=B, 2=C, 3=D)
      },
      {
        id: 2,
        question: 'Apa arti dari prinsip "Reduce" dalam gerakan 3R?',
        options: ['Mendaur ulang sampah menjadi produk baru', 'Menggunakan kembali barang bekas', 'Mengurangi penggunaan bahan yang berpotensi menjadi sampah', 'Membakar sampah di tempat pembuangan akhir'],
        answer: 2
      },
      {
        id: 3,
        question: 'Mengapa septic tank harus berjarak minimal 10 meter dari sumber air bersih?',
        options: ['Agar mudah dikuras', 'Agar air sumur tidak bau septic tank', 'Mencegah kontaminasi bakteri patogen ke sumber air bersih', 'Meningkatkan estetika halaman rumah'],
        answer: 2
      },
      {
        id: 4,
        question: 'Bahan manakah yang membutuhkan waktu paling lama untuk terurai secara alami?',
        options: ['Kertas koran', 'Kulit pisang', 'Plastik sekali pakai', 'Ranting pohon'],
        answer: 2
      }
    ];

    // ============================================================================
    // DATA MOCK: Laporan (UI STATIC / SIMULASI)
    // Nanti diganti dengan response dari tabel `laporan`
    // Status sesuai DB: 'menunggu', 'terverifikasi', 'ditolak'
    // (Ganti dari 'Pending' → 'menunggu' agar konsisten dengan database)
    // ============================================================================
    let reports = [
      {
        id: 1,
        name: 'Ahmad Fauzi',
        address: 'Jl. Merdeka No. 12, Kelurahan Hijau',
        title: 'Sampah Menumpuk di Pinggir Sungai',
        category: 'Sampah Liar',
        condition: 'Tumpukan sampah liar di pinggir sungai yang menyumbat aliran air dan menimbulkan bau busuk.',
        status: 'terverifikasi',
        date: '2026-06-02'
      },
      {
        id: 2,
        name: 'Siti Aminah',
        address: 'RT 04/RW 02, Desa Asri',
        title: 'Limbah Cair ke Parit',
        category: 'Pencemaran Air',
        condition: 'Limbah cair rumah tangga mengalir langsung ke parit warga tanpa penyaringan sehingga berwarna kehitaman.',
        status: 'menunggu',
        date: '2026-06-03'
      }
    ];

    // ============================================================================
    // DATA MOCK: Hasil Kuis (UI STATIC / SIMULASI)
    // Nanti diganti dengan response dari tabel `jawaban`
    // ============================================================================
    let quizResults = [
      { username: 'budisantoso@email.com', name: 'Budi Santoso', score: 75, status: 'Lulus', date: '2026-06-03' }
    ];

    // ============================================================================
    // DATA MOCK: Feedback (UI STATIC / SIMULASI)
    // Nanti diganti dengan response dari tabel `feedback`
    // ============================================================================
    let feedbacks = [];

    /* ============================================================================
     * STATE AKTIF
     * ============================================================================ */
    let currentUserSession = null;

    // ============================================================================
    // INISIALISASI PAGE
    // ============================================================================
    document.addEventListener("DOMContentLoaded", () => {
      lucide.createIcons();
    });

    // ============================================================================
    // HELPER: Toast Notification
    // ============================================================================
    function showToast(message, type = 'success') {
      const container = document.getElementById('toast-container');
      const toast = document.createElement('div');
      toast.className = `toast-animate flex items-center gap-3 p-4 rounded-xl shadow-lg border text-xs font-semibold bg-white ${
        type === 'success' ? 'border-emerald-100 text-emerald-800' : 'border-red-100 text-red-800'
      }`;
      
      const icon = type === 'success' ? 'check-circle' : 'alert-triangle';
      const iconColor = type === 'success' ? 'text-emerald-600' : 'text-red-500';
      
      toast.innerHTML = `
        <i data-lucide="${icon}" class="w-5 h-5 shrink-0 ${iconColor}"></i>
        <div class="flex-1">${message}</div>
      `;
      
      container.appendChild(toast);
      lucide.createIcons();

      setTimeout(() => {
        toast.style.animation = 'slideIn 0.3s reverse forwards';
        setTimeout(() => toast.remove(), 300);
      }, 3500);
    }

    // ============================================================================
    // HELPER: Toggle Mobile Menu
    // ============================================================================
    function toggleMobileMenu(menuId) {
      const menu = document.getElementById(menuId);
      menu.classList.toggle('hidden');
    }

    /* ============================================================================
     * [UC-01] REGISTRASI AKUN & SWITCH AUTH TAB
     * Sesuai DPPL UI: txtNama, txtEmail, txtPassword, txtConfirmPassword
     * Password minimal 8 karakter (sesuai DPPL UI)
     * ============================================================================ */
    function switchAuthTab(tab) {
      const tabLogin = document.getElementById('tab-login');
      const tabRegister = document.getElementById('tab-register');
      const loginForm = document.getElementById('login-form');
      const registerForm = document.getElementById('register-form');
      const errorAlert = document.getElementById('auth-error-alert');

      errorAlert.classList.add('hidden');

      if (tab === 'login') {
        tabLogin.className = 'flex-1 py-2 text-sm font-medium rounded-lg text-slate-800 bg-white shadow-sm transition-all duration-200';
        tabRegister.className = 'flex-1 py-2 text-sm font-medium rounded-lg text-slate-500 hover:text-slate-800 transition-all duration-200';
        loginForm.classList.remove('hidden');
        registerForm.classList.add('hidden');
      } else {
        tabRegister.className = 'flex-1 py-2 text-sm font-medium rounded-lg text-slate-800 bg-white shadow-sm transition-all duration-200';
        tabLogin.className = 'flex-1 py-2 text-sm font-medium rounded-lg text-slate-500 hover:text-slate-800 transition-all duration-200';
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
      }
    }

    function handleRegister(event) {
      event.preventDefault();
      const name = document.getElementById('reg-name').value.trim();
      const email = document.getElementById('reg-email').value.trim().toLowerCase();
      const password = document.getElementById('reg-password').value.trim();
      const confirmPassword = document.getElementById('reg-confirm-password').value.trim();
      const errorAlert = document.getElementById('auth-error-alert');

      errorAlert.classList.add('hidden');

      // Validasi email format
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        showAuthError('Format email tidak valid.');
        return;
      }

      // Validasi password minimal 8 karakter (sesuai DPPL UI)
      if (password.length < 8) {
        showAuthError('Password minimal 8 karakter.');
        return;
      }

      // Validasi konfirmasi password
      if (password !== confirmPassword) {
        showAuthError('Password dan konfirmasi password tidak sesuai.');
        return;
      }

      // Cek email sudah terdaftar (simulasi; nanti dicek oleh backend)
      const emailExists = users.some(u => u.email === email);
      if (emailExists) {
        showAuthError('Email sudah terdaftar. Gunakan email lain atau login.');
        return;
      }

      // Simpan user baru (simulasi; nanti dikirim ke backend untuk di-hash)
      users.push({ id: users.length + 1, email, password, role: 'user', name });
      showToast('Registrasi akun berhasil! Silakan login.', 'success');
      document.getElementById('register-form').reset();
      switchAuthTab('login');
    }

    /* ============================================================================
     * [UC-02] AUTENTIKASI LOGIN
     * Sesuai SKPL KNF-08: autentikasi berbasis email dan kata sandi
     * Sesuai DPPL UI: txtEmail, txtPassword
     * ============================================================================ */
    function handleLogin(event) {
      event.preventDefault();
      const email = document.getElementById('login-email').value.trim().toLowerCase();
      const password = document.getElementById('login-password').value.trim();
      const errorAlert = document.getElementById('auth-error-alert');

      errorAlert.classList.add('hidden');

      // Cari user berdasarkan EMAIL (bukan username)
      const user = users.find(u => u.email === email && u.password === password);
      
      if (!user) {
        showAuthError('Email atau password salah!');
        return;
      }

      // Set user session simulation
      currentUserSession = user;
      document.getElementById('login-form').reset();

      // Transparansi Navigasi Dashboard
      document.getElementById('auth-section').classList.add('hidden');
      
      if (user.role === 'admin') {
        document.getElementById('admin-section').classList.remove('hidden');
        document.getElementById('admin-profile-name').textContent = user.name;
        navigateToAdmin('dashboard');
        showToast(`Selamat datang Admin ${user.name}`, 'success');
      } else {
        document.getElementById('user-section').classList.remove('hidden');
        document.getElementById('user-profile-name').textContent = user.name;
        document.getElementById('user-welcome-heading').textContent = `Mulai Aksi Nyata Anda, ${user.name}!`;
        navigateToUser('beranda');
        showToast(`Selamat datang ${user.name}`, 'success');
      }
    }

    function showAuthError(msg) {
      const errorAlert = document.getElementById('auth-error-alert');
      const errorMsgText = document.getElementById('auth-error-msg');
      errorMsgText.textContent = msg;
      errorAlert.classList.remove('hidden');
    }

    /* ============================================================================
     * [UC-03] LOGOUT
     * ============================================================================ */
    function handleLogout() {
      currentUserSession = null;
      document.getElementById('user-section').classList.add('hidden');
      document.getElementById('admin-section').classList.add('hidden');
      document.getElementById('auth-section').classList.remove('hidden');
      switchAuthTab('login');
      showToast('Anda telah logout dengan sukses.', 'success');
    }


    /* ============================================================================
     * USER PAGES ROUTING (UC-04 to UC-08)
     * ============================================================================ */
    function navigateToUser(page) {
      const tabs = ['beranda', 'materi', 'kuis', 'laporan'];
      
      tabs.forEach(t => {
        const sec = document.getElementById(`section-user-${t}`);
        const nav = document.getElementById(`nav-user-${t}`);
        
        if (t === page) {
          sec.classList.remove('hidden');
          nav.className = 'px-4 py-2 rounded-lg text-sm font-semibold text-forest-700 bg-forest-50 transition-all';
        } else {
          sec.classList.add('hidden');
          nav.className = 'px-4 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:text-slate-900 transition-all';
        }
      });

      document.getElementById('user-mobile-menu').classList.add('hidden');

      if (page === 'beranda') {
        updateUserDashboardStats();
      } else if (page === 'materi') {
        loadUserMaterials();
      } else if (page === 'kuis') {
        loadUserQuiz();
      } else if (page === 'laporan') {
        loadUserRecentReports();
      }
    }

    function updateUserDashboardStats() {
      document.getElementById('user-stats-materi').textContent = `${materials.length} Topik Utama`;
      
      const attempts = quizResults.filter(r => r.username === currentUserSession.email);
      if (attempts.length > 0) {
        const highest = Math.max(...attempts.map(a => a.score));
        document.getElementById('user-stats-kuis').textContent = `Tertinggi: ${highest} / 100`;
      } else {
        document.getElementById('user-stats-kuis').textContent = `Belum Diikuti`;
      }

      const totalRep = reports.filter(r => r.name === currentUserSession.name).length;
      document.getElementById('user-stats-laporan').textContent = `${totalRep} Laporan`;
    }

    /* ============================================================================
     * [UC-04] AKSES MATERI EDUKASI (USER)
     * Data berasal dari array materials (simulasi) atau nanti dari tabel `edukasi`
     * ============================================================================ */
    function loadUserMaterials() {
      const grid = document.getElementById('user-materials-grid');
      grid.innerHTML = '';

      materials.forEach(mat => {
        const card = document.createElement('div');
        card.className = 'bg-white rounded-2xl border border-slate-100 shadow-sm p-6 hover:shadow-md transition-all flex flex-col justify-between';
        card.innerHTML = `
          <div class="space-y-3">
            <span class="inline-block text-[10px] uppercase font-bold text-forest-600 bg-forest-50 px-2.5 py-0.5 rounded-full">${mat.category}</span>
            <h3 class="font-bold text-slate-800 text-base leading-snug">${mat.title}</h3>
            <p class="text-xs text-slate-500 leading-relaxed">${mat.shortDesc}</p>
          </div>
          <button onclick="openMaterialModalView(${mat.id})" class="mt-5 w-full py-2 bg-slate-50 hover:bg-forest-50 hover:text-forest-700 text-slate-700 font-semibold text-xs rounded-xl border border-slate-100 hover:border-forest-200 transition-all flex items-center justify-center gap-1">
            <span>Baca Selengkapnya</span>
            <i data-lucide="book-open" class="w-3.5 h-3.5"></i>
          </button>
        `;
        grid.appendChild(card);
      });
      lucide.createIcons();
    }

    function openMaterialModalView(id) {
      const mat = materials.find(m => m.id === id);
      if (!mat) return;

      document.getElementById('modal-materi-category').textContent = mat.category;
      document.getElementById('modal-materi-title').textContent = mat.title;
      
      const body = document.getElementById('modal-materi-content');
      body.innerHTML = mat.content.split('\n\n').map(p => `<p class="mb-3">${p.replace(/\n/g, '<br>')}</p>`).join('');

      document.getElementById('modal-view-materi').classList.remove('hidden');
    }

    function closeMaterialModalView() {
      document.getElementById('modal-view-materi').classList.add('hidden');
    }

    /* ============================================================================
     * [UC-05] & [UC-06] IKUTI KUIS & LIHAT HASIL
     * Data berasal dari array quizQuestions (simulasi) atau nanti dari tabel `kuis` + `soal`
     * ============================================================================ */
    function loadUserQuiz() {
      const qList = document.getElementById('quiz-question-list');
      qList.innerHTML = '';

      if (quizQuestions.length === 0) {
        qList.innerHTML = `
          <div class="text-center py-12 text-slate-400 space-y-2">
            <i data-lucide="frown" class="w-12 h-12 mx-auto"></i>
            <p class="text-sm font-semibold">Saat ini bank soal belum tersedia.</p>
          </div>
        `;
        lucide.createIcons();
        loadQuizHistory();
        return;
      }

      quizQuestions.forEach((q, qIndex) => {
        const item = document.createElement('div');
        item.className = 'space-y-4';
        
        let optionsHTML = '';
        q.options.forEach((opt, optIndex) => {
          optionsHTML += `
            <label class="flex items-center gap-3 p-3.5 bg-slate-50 border border-slate-200 rounded-xl cursor-pointer hover:bg-forest-50/50 hover:border-forest-200 transition-all">
              <input type="radio" name="question-${q.id}" value="${optIndex}" class="h-4.5 w-4.5 text-forest-600 focus:ring-forest-500 border-slate-300">
              <span class="text-xs text-slate-700 font-medium">${opt}</span>
            </label>
          `;
        });

        item.innerHTML = `
          <div class="flex gap-3">
            <span class="w-6 h-6 rounded-full bg-forest-100 text-forest-700 flex items-center justify-center text-xs font-bold shrink-0">${qIndex + 1}</span>
            <p class="text-sm font-semibold text-slate-800 leading-normal">${q.question}</p>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pl-9">
            ${optionsHTML}
          </div>
        `;
        qList.appendChild(item);
      });
      loadQuizHistory();
    }

    function loadQuizHistory() {
      const container = document.getElementById('quiz-history-container');
      container.innerHTML = '';

      const attempts = quizResults.filter(r => r.username === currentUserSession.email);
      
      if (attempts.length === 0) {
        container.innerHTML = `
          <div class="text-center py-6 text-slate-400 text-xs">
            Belum ada rekam jejak kuis Anda.
          </div>
        `;
        return;
      }

      attempts.forEach(att => {
        const item = document.createElement('div');
        item.className = `flex justify-between items-center p-3 rounded-xl border ${
          att.status === 'Lulus' ? 'bg-emerald-50 border-emerald-100 text-emerald-800' : 'bg-rose-50 border-rose-100 text-rose-800'
        }`;
        
        item.innerHTML = `
          <div>
            <div class="text-xs font-bold">Skor: ${att.score} / 100</div>
            <div class="text-[9px] opacity-75">${att.date}</div>
          </div>
          <span class="px-2 py-0.5 rounded text-[10px] uppercase font-extrabold tracking-wider ${
            att.status === 'Lulus' ? 'bg-emerald-100 text-emerald-950' : 'bg-rose-100 text-rose-950'
          }">${att.status}</span>
        `;
        container.appendChild(item);
      });
    }

    function submitQuiz() {
      if (quizQuestions.length === 0) {
        showToast('Soal kuis kosong.', 'error');
        return;
      }

      let answeredCount = 0;
      let correctCount = 0;

      quizQuestions.forEach(q => {
        const selected = document.querySelector(`input[name="question-${q.id}"]:checked`);
        if (selected) {
          answeredCount++;
          if (parseInt(selected.value) === q.answer) {
            correctCount++;
          }
        }
      });

      if (answeredCount < quizQuestions.length) {
        showToast(`Mohon isi seluruh soal kuis (${answeredCount}/${quizQuestions.length} Terjawab).`, 'error');
        return;
      }

      // Calculate score out of 100
      const score = Math.round((correctCount / quizQuestions.length) * 100);
      const status = score >= 70 ? 'Lulus' : 'Gagal';
      const today = new Date().toISOString().split('T')[0];

      // Save to client-side (simulasi; nanti dikirim ke backend untuk disimpan di tabel `jawaban`)
      quizResults.unshift({
        username: currentUserSession.email,
        name: currentUserSession.name,
        score: score,
        status: status,
        date: today
      });

      // Reload view
      loadUserQuiz();
      
      if (status === 'Lulus') {
        showToast(`Hebat! Anda LULUS dengan skor ${score}!`, 'success');
      } else {
        showToast(`Skor Anda ${score}. Anda belum mencapai kriteria kelulusan (70). Silakan coba lagi!`, 'error');
      }
    }

    /* ============================================================================
     * [UC-07] KIRIM LAPORAN LINGKUNGAN
     * Sesuai DPPL UI: txtJudul, txtLokasi, ddlKategori, rtfDeskripsi, txtNamalaporan
     * Sesuai UC Kirim Laporan: "mengunggah bukti pendukung jika diperlukan"
     * Status default: 'menunggu' (sesuai tabel `laporan`.status_verifikasi)
     * ============================================================================ */
    function submitReport(event) {
      event.preventDefault();
      const title = document.getElementById('report-title').value.trim();
      const name = document.getElementById('report-name').value.trim();
      const address = document.getElementById('report-address').value.trim();
      const category = document.getElementById('report-category').value;
      const condition = document.getElementById('report-condition').value.trim();
      const today = new Date().toISOString().split('T')[0];

      // Jika ada file yang dipilih, bisa dikirim sebagai FormData ke backend nanti
      const evidenceFile = document.getElementById('report-evidence').files[0];

      reports.unshift({
        id: reports.length + 1,
        name: name,
        address: address,
        title: title,
        category: category,
        condition: condition,
        status: 'menunggu',  // Sesuai DB: ENUM('menunggu','terverifikasi','ditolak')
        date: today
      });

      document.getElementById('report-form').reset();
      showToast('Laporan Anda berhasil dikirim ke server. Status: menunggu verifikasi.', 'success');
      loadUserRecentReports();
    }

    function loadUserRecentReports() {
      const container = document.getElementById('user-recent-reports');
      container.innerHTML = '';

      const userReports = reports.filter(r => r.name === currentUserSession.name);

      if (userReports.length === 0) {
        container.innerHTML = `<p class="text-xs text-slate-400 text-center py-4">Belum ada laporan dari Anda.</p>`;
        return;
      }

      userReports.forEach(r => {
        const div = document.createElement('div');
        div.className = 'p-3 bg-slate-50 border border-slate-100 rounded-xl space-y-1.5';
        
        let statusBadge = '';
        if (r.status === 'menunggu') {
          statusBadge = `<span class="bg-amber-100 text-amber-800 text-[9px] px-2 py-0.5 rounded font-semibold uppercase tracking-wider">Menunggu</span>`;
        } else if (r.status === 'terverifikasi') {
          statusBadge = `<span class="bg-emerald-100 text-emerald-800 text-[9px] px-2 py-0.5 rounded font-semibold uppercase tracking-wider">Terverifikasi</span>`;
        } else {
          statusBadge = `<span class="bg-red-100 text-red-800 text-[9px] px-2 py-0.5 rounded font-semibold uppercase tracking-wider">Ditolak</span>`;
        }

        div.innerHTML = `
          <div class="flex justify-between items-center">
            <span class="text-[10px] text-slate-400">${r.date}</span>
            ${statusBadge}
          </div>
          <p class="text-xs font-semibold text-slate-700 truncate">${r.condition}</p>
          <div class="text-[10px] text-slate-400 truncate flex items-center gap-1">
            <i data-lucide="map-pin" class="w-3 h-3"></i> ${r.address}
          </div>
        `;
        container.appendChild(div);
      });
      lucide.createIcons();
    }

    /* ============================================================================
     * [UC-08] KIRIM FEEDBACK
     * Data akan disimpan di tabel `feedback` saat integrasi backend
     * ============================================================================ */
    function submitFeedback(event) {
      event.preventDefault();
      const name = document.getElementById('fb-name').value.trim();
      const msg = document.getElementById('fb-msg').value.trim();
      const today = new Date().toISOString().split('T')[0];

      feedbacks.push({ name, msg, date: today });
      document.getElementById('feedback-form').reset();
      showToast('Saran & kritik Anda sangat kami hargai. Terima kasih!', 'success');
    }


    /* ============================================================================
     * ADMIN PAGES NAVIGATION & RENDERING (UC-09 s/d UC-12)
     * ============================================================================ */
    function navigateToAdmin(page) {
      const tabs = ['dashboard', 'kelola-materi', 'kelola-kuis', 'verifikasi-laporan', 'statistik'];
      
      tabs.forEach(t => {
        const sec = document.getElementById(`section-admin-${t}`);
        const nav = document.getElementById(`nav-admin-${t}`);
        
        if (t === page) {
          sec.classList.remove('hidden');
          nav.className = 'px-4 py-2 rounded-lg text-sm font-semibold text-forest-700 bg-forest-50 transition-all';
        } else {
          sec.classList.add('hidden');
          nav.className = 'px-4 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:text-slate-900 transition-all';
        }
      });

      document.getElementById('admin-mobile-menu').classList.add('hidden');

      if (page === 'dashboard') {
        renderAdminDashboard();
      } else if (page === 'kelola-materi') {
        renderAdminMaterials();
      } else if (page === 'kelola-kuis') {
        renderAdminQuizList();
      } else if (page === 'verifikasi-laporan') {
        renderAdminVerification();
      } else if (page === 'statistik') {
        renderAdminDetailedStats();
      }
    }

    /* ============================================================================
     * [UC-12] LIHAT STATISTIK & REKAP KUIS
     * Statistik dihitung dari data yang ada (nanti dari query database)
     * TIDAK perlu tabel statistik khusus — dihitung dari tabel yang ada
     * ============================================================================ */
    function renderAdminDashboard() {
      // 1. Calculate Stats
      const totalWarga = users.filter(u => u.role === 'user').length;
      const totalLaporan = reports.length;
      const totalVerifikasi = reports.filter(r => r.status === 'terverifikasi').length;
      
      // Calculate Average Quiz Grade
      let avgScore = 0;
      if (quizResults.length > 0) {
        const totalScore = quizResults.reduce((acc, curr) => acc + curr.score, 0);
        avgScore = Math.round(totalScore / quizResults.length);
      }

      // Render Cards
      const container = document.getElementById('admin-stats-container');
      container.innerHTML = `
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-md transition-all">
          <div class="w-12 h-12 rounded-xl bg-forest-100 text-forest-700 flex items-center justify-center">
            <i data-lucide="users" class="w-6 h-6"></i>
          </div>
          <div>
            <p class="text-xs text-slate-500 font-medium">Total Warga Terdaftar</p>
            <h4 class="text-2xl font-bold text-slate-800 mt-0.5">${totalWarga} Orang</h4>
          </div>
        </div>
        <!-- Card 2 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-md transition-all">
          <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center">
            <i data-lucide="file-warning" class="w-6 h-6"></i>
          </div>
          <div>
            <p class="text-xs text-slate-500 font-medium">Total Laporan Masuk</p>
            <h4 class="text-2xl font-bold text-slate-800 mt-0.5">${totalLaporan} Laporan</h4>
          </div>
        </div>
        <!-- Card 3 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-md transition-all">
          <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
            <i data-lucide="check-circle-2" class="w-6 h-6"></i>
          </div>
          <div>
            <p class="text-xs text-slate-500 font-medium">Laporan Terverifikasi</p>
            <h4 class="text-2xl font-bold text-slate-800 mt-0.5">${totalVerifikasi} Laporan</h4>
          </div>
        </div>
        <!-- Card 4 -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 flex items-center gap-4 hover:shadow-md transition-all">
          <div class="w-12 h-12 rounded-xl bg-violet-100 text-violet-700 flex items-center justify-center">
            <i data-lucide="award" class="w-6 h-6"></i>
          </div>
          <div>
            <p class="text-xs text-slate-500 font-medium">Rata-rata Nilai Warga</p>
            <h4 class="text-2xl font-bold text-slate-800 mt-0.5">${avgScore} Poin</h4>
          </div>
        </div>
      `;

      // 2. Render Actionable Pending Reports Table List
      const repTable = document.getElementById('admin-dash-reports');
      repTable.innerHTML = '';
      const pendingRep = reports.filter(r => r.status === 'menunggu').slice(0, 4);

      if (pendingRep.length === 0) {
        repTable.innerHTML = `
          <tr>
            <td colspan="3" class="p-4 text-center text-slate-400">Tidak ada pengaduan pending.</td>
          </tr>
        `;
      } else {
        pendingRep.forEach(r => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td class="p-3 font-semibold text-slate-800">${r.name}</td>
            <td class="p-3"><span class="bg-amber-100 text-amber-800 px-2 py-0.5 rounded text-[10px]">Menunggu</span></td>
            <td class="p-3 text-right">
              <button onclick="changeReportStatus(${r.id}, 'terverifikasi')" class="text-forest-600 hover:underline">Verifikasi</button>
              <button onclick="changeReportStatus(${r.id}, 'ditolak')" class="text-red-600 hover:underline ml-1">Tolak</button>
            </td>
          `;
          repTable.appendChild(tr);
        });
      }

      // 3. Render Quiz Rekap
      const quizTable = document.getElementById('admin-dash-quizzes');
      quizTable.innerHTML = '';
      const latestQuiz = quizResults.slice(0, 4);

      if (latestQuiz.length === 0) {
        quizTable.innerHTML = `
          <tr>
            <td colspan="4" class="p-4 text-center text-slate-400">Belum ada aktivitas kuis.</td>
          </tr>
        `;
      } else {
        latestQuiz.forEach(q => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td class="p-3 font-semibold text-slate-800">${q.username}</td>
            <td class="p-3 font-semibold">${q.score}</td>
            <td class="p-3">
              <span class="px-2 py-0.5 rounded text-[10px] uppercase font-semibold ${
                q.status === 'Lulus' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800'
              }">${q.status}</span>
            </td>
            <td class="p-3 text-slate-400">${q.date}</td>
          `;
          quizTable.appendChild(tr);
        });
      }

      lucide.createIcons();
    }

    function renderAdminDetailedStats() {
      const totalRep = reports.length;
      const totalVerif = reports.filter(r => r.status === 'terverifikasi').length;
      const totalPending = reports.filter(r => r.status === 'menunggu').length;
      const totalDitolak = reports.filter(r => r.status === 'ditolak').length;

      const pctVerif = totalRep > 0 ? Math.round((totalVerif / totalRep) * 100) : 0;
      const pctPending = totalRep > 0 ? Math.round((totalPending / totalRep) * 100) : 0;
      const pctDitolak = totalRep > 0 ? Math.round((totalDitolak / totalRep) * 100) : 0;

      // Update Bar Simulation (UI effects)
      document.getElementById('stat-bar-pending-txt').textContent = `${pctPending}%`;
      document.getElementById('stat-bar-pending').style.width = `${pctPending}%`;

      document.getElementById('stat-bar-verified-txt').textContent = `${pctVerif}%`;
      document.getElementById('stat-bar-verified').style.width = `${pctVerif}%`;

      document.getElementById('stat-bar-rejected-txt').textContent = `${pctDitolak}%`;
      document.getElementById('stat-bar-rejected').style.width = `${pctDitolak}%`;

      // Quiz Rangkuman Stats
      let avgScore = 0;
      let passRate = 0;
      if (quizResults.length > 0) {
        const total = quizResults.reduce((acc, val) => acc + val.score, 0);
        avgScore = Math.round(total / quizResults.length);
        const passCount = quizResults.filter(q => q.status === 'Lulus').length;
        passRate = Math.round((passCount / quizResults.length) * 100);
      }

      document.getElementById('stat-avg-score').textContent = avgScore;
      document.getElementById('stat-pass-rate').textContent = `${passRate}%`;
      document.getElementById('stat-total-exams').textContent = `${quizResults.length} Kali`;
    }

    /* ============================================================================
     * [UC-09] KELOLA KONTEN EDUKASI (ADMIN CRUD)
     * Data berasal dari array materials (simulasi) atau nanti dari tabel `edukasi`
     * ============================================================================ */
    function renderAdminMaterials() {
      const table = document.getElementById('admin-materials-table');
      table.innerHTML = '';

      materials.forEach(mat => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
          <td class="p-4 font-semibold text-slate-800">${mat.category}</td>
          <td class="p-4 font-medium">${mat.title}</td>
          <td class="p-4 text-slate-500 max-w-xs truncate">${mat.shortDesc}</td>
          <td class="p-4 text-center space-x-2">
            <button onclick="openMaterialModal(${mat.id})" class="px-2.5 py-1 text-xs border border-slate-200 rounded-lg hover:bg-slate-100 transition-all font-semibold">Edit</button>
            <button onclick="deleteMaterial(${mat.id})" class="px-2.5 py-1 text-xs bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all font-semibold">Hapus</button>
          </td>
        `;
        table.appendChild(tr);
      });
    }

    function openMaterialModal(id = null) {
      const form = document.getElementById('material-admin-form');
      form.reset();
      
      if (id !== null) {
        const mat = materials.find(m => m.id === id);
        if (mat) {
          document.getElementById('admin-mat-id').value = mat.id;
          document.getElementById('admin-mat-title').value = mat.title;
          document.getElementById('admin-mat-category').value = mat.category;
          document.getElementById('admin-mat-short').value = mat.shortDesc;
          document.getElementById('admin-mat-content').value = mat.content;
          document.getElementById('modal-admin-materi-title').textContent = "Edit Materi Edukasi";
        }
      } else {
        document.getElementById('admin-mat-id').value = '';
        document.getElementById('modal-admin-materi-title').textContent = "Tambah Materi Baru";
      }

      document.getElementById('modal-admin-materi').classList.remove('hidden');
    }

    function closeMaterialFormModal() {
      document.getElementById('modal-admin-materi').classList.add('hidden');
    }

    function saveMaterial(event) {
      event.preventDefault();
      const id = document.getElementById('admin-mat-id').value;
      const title = document.getElementById('admin-mat-title').value.trim();
      const category = document.getElementById('admin-mat-category').value.trim();
      const shortDesc = document.getElementById('admin-mat-short').value.trim();
      const content = document.getElementById('admin-mat-content').value.trim();

      if (id) {
        // Edit Mode
        const index = materials.findIndex(m => m.id === parseInt(id));
        if (index !== -1) {
          materials[index] = { id: parseInt(id), title, category, shortDesc, content };
          showToast('Materi edukasi berhasil diperbarui.', 'success');
        }
      } else {
        // Add Mode
        const newId = materials.length > 0 ? Math.max(...materials.map(m => m.id)) + 1 : 1;
        materials.push({ id: newId, title, category, shortDesc, content });
        showToast('Materi edukasi baru ditambahkan.', 'success');
      }

      closeMaterialFormModal();
      renderAdminMaterials();
    }

    function deleteMaterial(id) {
      if (confirm('Apakah Anda yakin ingin menghapus materi edukasi ini?')) {
        materials = materials.filter(m => m.id !== id);
        showToast('Materi berhasil dihapus.', 'success');
        renderAdminMaterials();
      }
    }

    /* ============================================================================
     * [UC-10] KELOLA SOAL & KUIS (ADMIN CRUD)
     * Data berasal dari array quizQuestions (simulasi) atau nanti dari tabel `kuis` + `soal`
     * ============================================================================ */
    function renderAdminQuizList() {
      const container = document.getElementById('admin-quiz-list');
      container.innerHTML = '';

      if (quizQuestions.length === 0) {
        container.innerHTML = `<p class="text-slate-400 text-center py-6 text-xs">Belum ada bank soal terdaftar.</p>`;
        return;
      }

      quizQuestions.forEach((q, idx) => {
        const card = document.createElement('div');
        card.className = 'p-4 bg-slate-50 border border-slate-100 rounded-xl flex items-start justify-between gap-4';
        
        let optList = '';
        q.options.forEach((opt, optIdx) => {
          const isCorrect = optIdx === q.answer;
          optList += `
            <li class="flex items-center gap-1.5 mt-1 text-xs">
              <span class="w-1.5 h-1.5 rounded-full ${isCorrect ? 'bg-emerald-500' : 'bg-slate-300'}"></span>
              <span class="${isCorrect ? 'font-bold text-emerald-800' : 'text-slate-600'}">${opt}</span>
              ${isCorrect ? '<span class="text-[9px] font-bold text-emerald-600 ml-1 bg-emerald-50 px-1.5 rounded">Kunci</span>' : ''}
            </li>
          `;
        });

        card.innerHTML = `
          <div class="space-y-2 flex-1">
            <div class="flex items-center gap-2">
              <span class="px-2 py-0.5 bg-forest-100 text-forest-800 font-bold text-[10px] rounded">Soal ${idx + 1}</span>
            </div>
            <p class="text-sm font-semibold text-slate-800">${q.question}</p>
            <ul class="pl-2 space-y-1">
              ${optList}
            </ul>
          </div>
          <button onclick="deleteQuizQuestion(${q.id})" class="px-2 py-1 bg-red-50 text-red-600 font-bold text-xs rounded-lg hover:bg-red-100 transition-all shrink-0">
            Hapus
          </button>
        `;
        container.appendChild(card);
      });
    }

    function openQuizModal() {
      document.getElementById('quiz-admin-form').reset();
      document.getElementById('modal-admin-quiz').classList.remove('hidden');
    }

    function closeQuizModal() {
      document.getElementById('modal-admin-quiz').classList.add('hidden');
    }

    function saveQuizQuestion(event) {
      event.preventDefault();
      const question = document.getElementById('admin-q-text').value.trim();
      const options = [
        document.getElementById('admin-opt-0').value.trim(),
        document.getElementById('admin-opt-1').value.trim(),
        document.getElementById('admin-opt-2').value.trim(),
        document.getElementById('admin-opt-3').value.trim()
      ];
      const correctRadio = document.querySelector('input[name="correct-opt"]:checked');

      if (!correctRadio) {
        showToast('Mohon pilih satu opsi jawaban yang benar.', 'error');
        return;
      }

      const answer = parseInt(correctRadio.value);
      const newId = quizQuestions.length > 0 ? Math.max(...quizQuestions.map(q => q.id)) + 1 : 1;

      quizQuestions.push({ id: newId, question, options, answer });
      showToast('Soal kuis baru berhasil disimpan.', 'success');

      closeQuizModal();
      renderAdminQuizList();
    }

    function deleteQuizQuestion(id) {
      if (confirm('Apakah Anda yakin ingin menghapus pertanyaan kuis ini?')) {
        quizQuestions = quizQuestions.filter(q => q.id !== id);
        showToast('Soal berhasil dihapus.', 'success');
        renderAdminQuizList();
      }
    }

    /* ============================================================================
     * [UC-11] VERIFIKASI LAPORAN USER (ADMIN ACTION)
     * Status sesuai DB: 'menunggu', 'terverifikasi', 'ditolak'
     * ============================================================================ */
    function renderAdminVerification() {
      const table = document.getElementById('admin-verification-table');
      table.innerHTML = '';

      if (reports.length === 0) {
        table.innerHTML = `
          <tr>
            <td colspan="6" class="p-6 text-center text-slate-400 font-semibold text-xs">Belum ada laporan dari warga.</td>
          </tr>
        `;
        return;
      }

      reports.forEach(r => {
        const tr = document.createElement('tr');
        
        let badge = '';
        let actButtons = '';
        if (r.status === 'menunggu') {
          badge = `<span class="bg-amber-100 text-amber-800 font-semibold px-2 py-0.5 rounded text-[10px]">Menunggu</span>`;
          actButtons = `
            <button onclick="changeReportStatus(${r.id}, 'terverifikasi')" class="px-2.5 py-1 text-xs bg-emerald-50 text-emerald-700 rounded-lg hover:bg-emerald-100 transition-all font-semibold">Setujui</button>
            <button onclick="changeReportStatus(${r.id}, 'ditolak')" class="px-2.5 py-1 text-xs bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-all font-semibold">Tolak</button>
          `;
        } else if (r.status === 'terverifikasi') {
          badge = `<span class="bg-emerald-100 text-emerald-800 font-semibold px-2 py-0.5 rounded text-[10px]">Terverifikasi</span>`;
          actButtons = `<button onclick="changeReportStatus(${r.id}, 'menunggu')" class="px-2.5 py-1 text-xs bg-amber-50 text-amber-700 rounded-lg hover:bg-amber-100 transition-all font-semibold">Kembali ke Menunggu</button>`;
        } else {
          badge = `<span class="bg-red-100 text-red-800 font-semibold px-2 py-0.5 rounded text-[10px]">Ditolak</span>`;
          actButtons = `<button onclick="changeReportStatus(${r.id}, 'menunggu')" class="px-2.5 py-1 text-xs bg-amber-50 text-amber-700 rounded-lg hover:bg-amber-100 transition-all font-semibold">Kembali ke Menunggu</button>`;
        }

        tr.innerHTML = `
          <td class="p-4 text-slate-400 font-semibold whitespace-nowrap">${r.date}</td>
          <td class="p-4 font-bold text-slate-800">${r.name}</td>
          <td class="p-4 max-w-[150px] truncate text-slate-500" title="${r.address}">${r.address}</td>
          <td class="p-4 max-w-[250px] font-medium text-slate-700 leading-normal" title="${r.condition}">${r.condition}</td>
          <td class="p-4">${badge}</td>
          <td class="p-4 text-center space-x-2 whitespace-nowrap">
            ${actButtons}
            <button onclick="deleteReport(${r.id})" class="px-2.5 py-1 text-xs bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all font-semibold">Hapus</button>
          </td>
        `;
        table.appendChild(tr);
      });
    }

    function changeReportStatus(id, newStatus) {
      const rep = reports.find(r => r.id === id);
      if (rep) {
        rep.status = newStatus;
        const statusLabel = newStatus === 'menunggu' ? 'Menunggu' : newStatus === 'terverifikasi' ? 'Terverifikasi' : 'Ditolak';
        showToast(`Laporan ${rep.name} telah diubah menjadi ${statusLabel}.`, 'success');
        
        // Rerender active panel
        const currentActive = document.querySelector('button[id^="nav-admin-"].bg-forest-50');
        if (currentActive) {
          const tabName = currentActive.id.replace('nav-admin-', '');
          if (tabName === 'dashboard') renderAdminDashboard();
          if (tabName === 'verifikasi-laporan') renderAdminVerification();
        }
      }
    }

    function deleteReport(id) {
      if (confirm('Apakah Anda yakin ingin menghapus laporan pengaduan warga ini?')) {
        reports = reports.filter(r => r.id !== id);
        showToast('Laporan warga berhasil dibersihkan.', 'success');
        renderAdminVerification();
      }
    }

  </script>
</body>
</html>
