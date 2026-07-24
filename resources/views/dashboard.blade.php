@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Background Corporate Image with Light Overlay -->
<div class="min-h-screen flex flex-col justify-between relative overflow-hidden bg-slate-900" 
     style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    
    <!-- Light theme blur overlay to make the content readable -->
    <div class="absolute inset-0 bg-slate-100/85 backdrop-blur-[2px]"></div>

    <!-- Header Navigation -->
    <header class="bg-white/75 backdrop-blur-md relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center space-x-3.5">
                    <div class="h-9 w-9 bg-gradient-to-tr from-indigo-650 to-indigo-500 rounded-lg flex items-center justify-center shadow-md shadow-indigo-600/10">
                        <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold tracking-tight text-slate-900">PT BINTANG ANUGRAH</span>
                </div>
                
                <div class="flex items-center space-x-4">
                    <span class="inline-block text-xs font-bold px-3 py-1 bg-indigo-50 text-indigo-755 rounded-full">
                        {{ $roleLabel }}
                    </span>
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                            class="inline-flex items-center justify-center px-3.5 py-1.5 text-xs font-semibold text-slate-700 hover:text-slate-900 bg-white hover:bg-slate-55 rounded-xl transition duration-150 transform hover:-translate-y-0.5 shadow-sm">
                            <svg class="h-4 w-4 mr-1.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow flex items-center justify-center px-4 relative z-10 py-10">
        <div class="max-w-3xl w-full text-center space-y-6 animate__animated animate__zoomIn animate__faster">
            
            <!-- Connection Status Indicator -->
            <div class="inline-flex items-center justify-center py-1.5 px-3.5 bg-white rounded-full shadow-sm">
                <span class="flex h-2 w-2 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-450 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                <span class="ml-2 text-xs font-bold text-slate-600">Sistem Presensi Aktif</span>
            </div>

            <!-- Welcome Greeting Card -->
            <div class="bg-white rounded-2xl p-8 md:p-12 shadow-2xl relative">
                <!-- Inner top soft gradient line -->
                <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-indigo-500 via-indigo-400 to-indigo-500 rounded-t-2xl"></div>
                
                <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    Hai, <span class="bg-gradient-to-r from-indigo-600 to-indigo-500 bg-clip-text text-transparent">{{ $user->name }}</span>
                </h1>
                
                <p class="mt-4 text-base md:text-xl text-slate-600 font-medium max-w-xl mx-auto">
                    Selamat datang di <span class="text-indigo-650 font-bold">PT BINTANG ANUGRAH</span>
                </p>

                <!-- Information Grid -->
                <div class="mt-8 pt-8 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-md mx-auto">
                    <div class="bg-slate-50 rounded-xl p-4 text-left">
                        <span class="block text-2xs text-slate-400 uppercase tracking-widest font-bold">Username</span>
                        <span class="block text-sm font-bold text-slate-800 mt-0.5">{{ $user->username }}</span>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 text-left">
                        <span class="block text-2xs text-slate-400 uppercase tracking-widest font-bold">ID Karyawan</span>
                        <span class="block text-sm font-bold text-slate-800 mt-0.5">{{ $user->employee_code }}</span>
                    </div>
                </div>
            </div>

            <!-- Access Level Badge / Registered info -->
            <p class="text-2xs text-slate-500 uppercase tracking-widest font-bold">
                Tingkat Akses: <span class="text-indigo-600">{{ $user->role }}</span> &bull; Tanggal Bergabung: {{ $user->hire_date ? $user->hire_date->format('d M Y') : '-' }}
            </p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white/75 py-5 text-center relative z-25">
        <p class="text-xs font-semibold text-slate-500">
            &copy; 2026 PT BINTANG ANUGRAH. Seluruh hak cipta dilindungi undang-undang.
        </p>
    </footer>
</div>
@endsection
