<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EcoLearn - Edukasi & Pengelolaan Kebersihan Lingkungan</title>
  <!-- SEO Meta Tags -->
  <meta name="description" content="EcoLearn adalah platform edukasi interaktif kebersihan lingkungan berbasis web. Kelola materi, ikuti kuis, laporkan kondisi lingkungan, dan bantu jaga kelestarian bumi kita.">
  <meta name="author" content="EcoLearn Team">
  <meta name="robots" content="index, follow">
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            forest: {
              50: '#f2f8f4',
              100: '#e0efe5',
              200: '#c3decb',
              300: '#9bc4a8',
              400: '#6fa480',
              500: '#4c8660',
              600: '#3a6c4b',
              700: '#2f563d',
              800: '#274632',
              900: '#213a2a',
              950: '#112017',
            }
          },
          fontFamily: {
            sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
          }
        }
      }
    }
  </script>

  <!-- Google Fonts & Lucide Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    .custom-scrollbar::-webkit-scrollbar {
      width: 6px;
      height: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
      background: #f1f5f9;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }
    /* Toast transition */
    #toast-container {
      perspective: 1000px;
    }
    .toast-animate {
      animation: slideIn 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes slideIn {
      from { transform: translateY(100%) scale(0.9); opacity: 0; }
      to { transform: translateY(0) scale(1); opacity: 1; }
    }
  </style>
</head>
<body class="h-full flex flex-col selection:bg-forest-100 selection:text-forest-900 custom-scrollbar">

  <!-- ========================================================================= -->
  <!-- TOAST NOTIFICATION CONTAINER -->
  <!-- ========================================================================= -->
  <div id="toast-container" class="fixed bottom-5 right-5 z-50 flex flex-col gap-3 max-w-sm w-full"></div>
