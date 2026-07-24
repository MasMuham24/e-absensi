@extends('layouts.auth')

@section('title', 'Login Presensi')

@section('content')
<!-- Background Corporate Image with Overlay -->
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden bg-slate-900" 
     style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center;">
    
    <!-- Light theme blur overlay to make the content readable -->
    <div class="absolute inset-0 bg-slate-100/80 backdrop-blur-[2px]"></div>

    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-2xl relative z-10 animate__animated animate__fadeInUp animate__faster">
        
        <!-- Header / Logo -->
        <div class="text-center">
            <div class="mx-auto h-12 w-12 bg-gradient-to-tr from-indigo-650 to-indigo-500 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-650/20">
                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            
            <h2 class="mt-5 text-2xl font-bold text-slate-900 tracking-tight">
                Sistem Informasi Presensi
            </h2>
            <p class="mt-1 text-xs font-semibold text-indigo-600 uppercase tracking-widest">
                PT BINTANG ANUGRAH
            </p>
        </div>

        <!-- Login Form -->
        <form class="mt-8 space-y-5" action="{{ route('login.store') }}" method="POST">
            @csrf
            
            <div class="space-y-4">
                <!-- Username Input -->
                <div>
                    <label for="username" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input id="username" name="username" type="text" required value="{{ old('username') }}" 
                            class="appearance-none block w-full pl-11 pr-4 py-3 rounded-xl bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200 text-sm" 
                            placeholder="Masukkan username Anda">
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1.5">Password</label>
                    <div class="relative" x-data="{ show: false }">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" name="password" :type="show ? 'text' : 'password'" required 
                            class="appearance-none block w-full pl-11 pr-10 py-3 rounded-xl bg-slate-50 text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-200 text-sm" 
                            placeholder="Masukkan password Anda">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-700 transition duration-150">
                            <!-- eye icon -->
                            <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            <!-- eye-off icon -->
                            <svg x-show="show" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.024 10.024 0 014.168-5.464M1.14 1.14l21.72 21.72M8.336 8.336a3 3 0 004.128 4.128m0 0a3 3 0 00-4.128-4.128m0 0L1 1m11 11l11 11" /></svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Remember Me checkbox -->
            <div class="flex items-center">
                <input id="remember" name="remember" type="checkbox" 
                    class="h-4 w-4 text-indigo-650 focus:ring-indigo-500/20 border-slate-300 rounded bg-slate-50">
                <label for="remember" class="ml-2 block text-xs text-slate-500 font-semibold select-none">
                    Ingat sesi masuk saya
                </label>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit" 
                    class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 transform hover:-translate-y-0.5 shadow-lg shadow-indigo-600/25">
                    Masuk ke Sistem
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
