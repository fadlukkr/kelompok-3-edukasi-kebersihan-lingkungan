@extends('layouts.auth')
@section('title', 'Login')

@section('form')
@php $inp = 'w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-slate-800 text-sm focus:outline-none focus:ring-2 focus:ring-forest-500 focus:border-forest-500 transition-all'; @endphp
<form method="POST" action="{{ route('login.post') }}" class="space-y-4">
  @csrf
  <div>
    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">Email</label>
    <div class="relative">
      <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i data-lucide="mail" class="w-4.5 h-4.5"></i></span>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="{{ $inp }}" placeholder="masukkan@email.com">
    </div>
  </div>
  <div>
    <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1.5">Password</label>
    <div class="relative">
      <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400"><i data-lucide="lock" class="w-4.5 h-4.5"></i></span>
      <input type="password" id="password" name="password" required autocomplete="current-password" class="{{ $inp }}" placeholder="••••••••">
    </div>
  </div>
  <button type="submit" class="w-full py-3 bg-forest-600 hover:bg-forest-700 active:scale-[0.99] text-white font-semibold rounded-xl shadow-lg shadow-forest-100 hover:shadow-forest-200 transition-all flex items-center justify-center gap-2">
    <span>Masuk</span>
    <i data-lucide="arrow-right" class="w-4.5 h-4.5"></i>
  </button>
</form>
@endsection