@extends('layouts.app')

@section('content')
@php
  $tabOn  = 'flex-1 py-2 text-sm font-medium rounded-lg text-center text-slate-800 bg-white shadow-sm transition-all duration-200';
  $tabOff = 'flex-1 py-2 text-sm font-medium rounded-lg text-center text-slate-500 hover:text-slate-800 transition-all duration-200';
@endphp
<section class="flex-1 flex items-center justify-center p-4 bg-gradient-to-br from-forest-50 via-slate-50 to-emerald-50">
  <div class="w-full max-w-md bg-white/80 backdrop-blur-md rounded-2xl shadow-xl border border-slate-100 p-8 transition-all duration-300">

    <div class="flex flex-col items-center mb-8">
      <div class="w-14 h-14 bg-forest-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-forest-200 mb-3">
        <i data-lucide="leaf" class="w-8 h-8"></i>
      </div>
      <h1 class="text-2xl font-bold text-slate-800 tracking-tight">EcoLearn</h1>
      <p class="text-xs text-slate-500 mt-1">Edukasi &amp; Aksi Kebersihan Lingkungan</p>
    </div>

    <div class="flex bg-slate-100 p-1 rounded-xl mb-6">
      <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? $tabOn : $tabOff }}">Login</a>
      <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? $tabOn : $tabOff }}">Registrasi</a>
    </div>

    @if ($errors->any())
      <div class="mb-4 p-3 bg-red-50 border-l-4 border-red-500 rounded text-red-700 text-sm flex items-center gap-2">
        <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
        <span>{{ $errors->first() }}</span>
      </div>
    @endif

    @yield('form')
  </div>
</section>
@endsection