<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'EcoLearn') - EcoLearn</title>
  <meta name="description" content="EcoLearn adalah platform edukasi interaktif kebersihan lingkungan berbasis web.">

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: { extend: {
        colors: { forest: {
          50:'#f2f8f4',100:'#e0efe5',200:'#c3decb',300:'#9bc4a8',400:'#6fa480',
          500:'#4c8660',600:'#3a6c4b',700:'#2f563d',800:'#274632',900:'#213a2a',950:'#112017'
        }},
        fontFamily: { sans: ['Inter','system-ui','-apple-system','sans-serif'] }
      }}
    }
  </script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>

  <style>
    body { font-family: 'Inter', sans-serif; }
    .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f5f9; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    .toast-animate { animation: slideIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    @keyframes slideIn {
      from { transform: translateY(100%) scale(0.9); opacity: 0; }
      to   { transform: translateY(0) scale(1); opacity: 1; }
    }
  </style>
  @stack('styles')
</head>
<body class="h-full flex flex-col selection:bg-forest-100 selection:text-forest-900 custom-scrollbar">

  <div id="toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col gap-3 max-w-sm w-full"></div>

  @yield('content')

  <footer class="bg-slate-900 border-t border-slate-800 py-6 text-center text-slate-500 text-xs mt-auto">
    <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
      <div class="flex items-center gap-2">
        <div class="w-6 h-6 bg-forest-600 text-white rounded-md flex items-center justify-center">
          <i data-lucide="leaf" class="w-3.5 h-3.5"></i>
        </div>
        <span class="font-bold text-sm text-slate-300">EcoLearn</span>
      </div>
      <p>&copy; {{ date('Y') }} EcoLearn Platform. Kelestarian bumi di tangan kita bersama.</p>
    </div>
  </footer>

  <script>
    function showToast(message, type = 'success') {
      const container = document.getElementById('toast-container');
      const toast = document.createElement('div');
      toast.className = `toast-animate flex items-center gap-3 p-4 rounded-xl shadow-lg border text-xs font-semibold bg-white ${
        type === 'success' ? 'border-emerald-100 text-emerald-800' : 'border-red-100 text-red-800'}`;
      const icon = type === 'success' ? 'check-circle' : 'alert-triangle';
      const iconColor = type === 'success' ? 'text-emerald-600' : 'text-red-500';
      toast.innerHTML = `<i data-lucide="${icon}" class="w-5 h-5 shrink-0 ${iconColor}"></i><div class="flex-1"></div>`;
      toast.querySelector('div').textContent = message;   // textContent: aman dari XSS
      container.appendChild(toast);
      lucide.createIcons();
      setTimeout(() => {
        toast.style.animation = 'slideIn 0.3s reverse forwards';
        setTimeout(() => toast.remove(), 300);
      }, 3500);
    }

    function toggleMobileMenu(id) { document.getElementById(id).classList.toggle('hidden'); }

    document.addEventListener('DOMContentLoaded', () => {
      lucide.createIcons();
      @if (session('success')) showToast(@js(session('success')), 'success'); @endif
      @if (session('error'))   showToast(@js(session('error')), 'error');   @endif
    });
  </script>
  @stack('scripts')
</body>
</html>