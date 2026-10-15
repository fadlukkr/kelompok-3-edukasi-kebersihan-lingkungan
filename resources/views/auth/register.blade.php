@extends('layouts.auth')
@section('title', 'Registrasi')

@section('form')
@php $inp = 'w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all'; @endphp
<form method="POST" action="{{ route('register.post') }}" class="space-y-4">
  @csrf
  <div>
    <label for="nama_lengkap" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">Nama Lengkap</label>
    <div class="relative">
      <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i data-lucide="tag" class="w-4.5 h-4.5"></i></span>
      <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required class="{{ $inp }}" placeholder="Nama Lengkap Anda">
    </div>
  </div>
  <div>
    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">Email</label>
    <div class="relative">
      <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i data-lucide="mail" class="w-4.5 h-4.5"></i></span>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="{{ $inp }}" placeholder="email@contoh.com">
    </div>
  </div>
  <div>
    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">Password</label>
    <div class="relative">
      <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i data-lucide="lock" class="w-4.5 h-4.5"></i></span>
      <input type="password" id="password" name="password" required minlength="8" autocomplete="new-password" class="{{ $inp }}" placeholder="Min. 8 karakter">
    </div>
  </div>
  <div>
    <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">Konfirmasi Password</label>
    <div class="relative">
      <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i data-lucide="lock" class="w-4.5 h-4.5"></i></span>
      <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" class="{{ $inp }}" placeholder="Ulangi password">
    </div>
  </div>
  <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 active:scale-[0.99] text-white font-semibold rounded-xl shadow-lg shadow-emerald-100 hover:shadow-emerald-200 transition-all flex items-center justify-center gap-2">
    <span>Daftar Sekarang</span>
    <i data-lucide="user-plus" class="w-4.5 h-4.5"></i>
  </button>
</form>
@endsection