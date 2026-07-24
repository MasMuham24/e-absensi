@extends('layouts.app')

@section('title', 'Dashboard HR')

@section('content')
<!-- Background Corporate Image with Light Overlay -->
<div class="min-h-screen flex flex-col justify-between relative overflow-hidden bg-slate-900" 
     style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    
    <!-- Light theme blur overlay to make the content readable -->
    <div class="absolute inset-0 bg-slate-100/85 backdrop-blur-[2px]"></div>

    <!-- Header Navigation -->
    <header class="bg-white/75 backdrop-blur-md relative z-20 shadow-sm">
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
                    <span class="inline-block text-xs font-bold px-3 py-1 bg-emerald-50 text-emerald-755 rounded-full">
                        Human Resource
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
    <main class="flex-grow flex flex-col items-center justify-start px-4 relative z-10 py-10 w-full">
        <div class="max-w-7xl w-full space-y-8 animate__animated animate__fadeInUp animate__faster">
            
            <!-- Welcome Header -->
            <div class="text-center space-y-2">
                <div class="inline-flex items-center justify-center py-1.5 px-3.5 bg-white rounded-full shadow-sm">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-450 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="ml-2 text-xs font-bold text-slate-600">Sistem Presensi Aktif</span>
                </div>

                <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
                    Hai, <span class="bg-gradient-to-r from-emerald-600 to-emerald-500 bg-clip-text text-transparent">{{ $user->name }}</span>
                </h1>
                
                <p class="text-base md:text-xl text-slate-600 font-medium max-w-xl mx-auto">
                    Selamat datang di <span class="text-emerald-650 font-bold">Panel Human Resource</span>
                </p>
            </div>

            <!-- Stats Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                <!-- Total Karyawan -->
                <div class="bg-white rounded-2xl p-6 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/5 rounded-full blur-2xl -translate-x-1/2 translate-y-1/2"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <p class="text-2xs text-slate-400 uppercase tracking-widest font-bold mb-1">Total Karyawan</p>
                            <p class="text-3xl md:text-4xl font-extrabold text-slate-900">{{ $stats['total_employees'] ?? '127' }}</p>
                            <p class="text-xs text-emerald-600 font-semibold mt-1 flex items-center gap-1">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                                Aktif
                            </p>
                        </div>
                        <div class="h-14 w-14 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Cuti Pending Approval -->
                <div class="bg-white rounded-2xl p-6 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-500/5 rounded-full blur-2xl -translate-x-1/2 translate-y-1/2"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <p class="text-2xs text-slate-400 uppercase tracking-widest font-bold mb-1">Cuti Pending</p>
                            <p class="text-3xl md:text-4xl font-extrabold text-slate-900">{{ $stats['pending_leaves'] ?? '7' }}</p>
                            <p class="text-xs text-amber-600 font-semibold mt-1">Menunggu Persetujuan</p>
                        </div>
                        <div class="h-14 w-14 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Karyawan Terlambat Hari Ini -->
                <div class="bg-white rounded-2xl p-6 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-red-500/5 rounded-full blur-2xl -translate-x-1/2 translate-y-1/2"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <p class="text-2xs text-slate-400 uppercase tracking-widest font-bold mb-1">Terlambat Hari Ini</p>
                            <p class="text-3xl md:text-4xl font-extrabold text-slate-900">{{ $stats['late_today'] ?? '5' }}</p>
                            <p class="text-xs text-red-600 font-semibold mt-1">Perlu Perhatian</p>
                        </div>
                        <div class="h-14 w-14 bg-red-50 rounded-xl flex items-center justify-center text-red-600">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- On Leave Today -->
                <div class="bg-white rounded-2xl p-6 shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-violet-500/5 rounded-full blur-2xl -translate-x-1/2 translate-y-1/2"></div>
                    <div class="relative flex items-center justify-between">
                        <div>
                            <p class="text-2xs text-slate-400 uppercase tracking-widest font-bold mb-1">Cuti Hari Ini</p>
                            <p class="text-3xl md:text-4xl font-extrabold text-slate-900">{{ $stats['on_leave_today'] ?? '3' }}</p>
                            <p class="text-xs text-violet-600 font-semibold mt-1">Sedang Tidak Hadir</p>
                        </div>
                        <div class="h-14 w-14 bg-violet-50 rounded-xl flex items-center justify-center text-violet-600">
                            <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Persetujuan Cuti -->
                <a href="{{ route('hr.leaves.pending') }}" class="group bg-white rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-100">
                    <div class="flex items-start justify-between mb-4">
                        <div class="h-12 w-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 group-hover:bg-amber-100 transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-2xs text-slate-400 uppercase tracking-widest font-bold">Persetujuan</span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1">Persetujuan Cuti</h3>
                    <p class="text-sm text-slate-500">Review dan setujui/tolak pengajuan cuti karyawan</p>
                </a>

                <!-- Data Karyawan -->
                <a href="{{ route('hr.employees.index') }}" class="group bg-white rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-100">
                    <div class="flex items-start justify-between mb-4">
                        <div class="h-12 w-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 group-hover:bg-emerald-100 transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <span class="text-2xs text-slate-400 uppercase tracking-widest font-bold">Data</span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1">Data Karyawan</h3>
                    <p class="text-sm text-slate-500">Lihat profil, riwayat cuti, & performa kehadiran</p>
                </a>

                <!-- Laporan HR -->
                <a href="{{ route('hr.reports.index') }}" class="group bg-white rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 border border-slate-100">
                    <div class="flex items-start justify-between mb-4">
                        <div class="h-12 w-12 bg-violet-50 rounded-xl flex items-center justify-center text-violet-600 group-hover:bg-violet-100 transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <span class="text-2xs text-slate-400 uppercase tracking-widest font-bold">Laporan</span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1">Laporan Kehadiran</h3>
                    <p class="text-sm text-slate-500">Rekap absensi bulanan, analisis keterlambatan, & cuti</p>
                </a>
            </div>

            <!-- Recent Activity / Quick Stats Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <!-- Cuti Terbaru Butuh Approval -->
                <div class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-sm font-bold text-slate-900">Pengajuan Cuti Terbaru</h4>
                        <a href="{{ route('hr.leaves.pending') }}" class="text-xs text-emerald-600 font-semibold hover:underline">Lihat Semua</a>
                    </div>
                    <div class="space-y-3">
                        @foreach($pendingLeaves ?? [] as $leave)
                        <div class="flex items-center justify-between py-2 border-b border-slate-100 last:border-0">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 bg-gradient-to-tr from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                    {{ Str::upper($leave['user']['name'][0] ?? '?') }}
                                </div>
                                <div>
                                    <p class="font-medium text-slate-800 text-sm">{{ $leave['user']['name'] ?? 'Nama Karyawan' }}</p>
                                    <p class="text-xs text-slate-400">{{ $leave['start_date'] ?? 'Tgl Mulai' }} s.d {{ $leave['end_date'] ?? 'Tgl Selesai' }}</p>
                                </div>
                            </div>
                            <span class="text-xs bg-amber-50 text-amber-700 px-2 py-1 rounded-full font-semibold">Pending</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Karyawan Terlambat -->
                <div class="bg-white rounded-2xl p-6 shadow-xl border border-slate-100">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-sm font-bold text-slate-900">Karyawan Terlambat Hari Ini</h4>
                    </div>
                    <div class="space-y-3">
                        @foreach($lateEmployees ?? [] as $emp)
                        <div class="flex items-center justify-between py-2 border-b border-slate-100 last:border-0">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 bg-gradient-to-tr from-red-500 to-red-600 rounded-lg flex items-center justify-center text-white font-bold text-sm">
                                    {{ Str::upper($emp['name'][0] ?? '?') }}
                                </div>
                                <div>
                                    <p class="font-medium text-slate-800 text-sm">{{ $emp['name'] ?? 'Nama Karyawan' }}</p>
                                    <p class="text-xs text-slate-400">{{ $emp['department'] ?? 'Departemen' }} - Datang: {{ $emp['check_in'] ?? '09:15' }}</p>
                                </div>
                            </div>
                            <span class="text-xs bg-red-50 text-red-700 px-2 py-1 rounded-full font-semibold">Terlambat</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-200/80 bg-white/75 py-5 text-center relative z-25">
        <p class="text-xs font-semibold text-slate-500">
            &copy; 2026 PT BINTANG ANUGRAH. Seluruh hak cipta dilindungi undang-undang.
        </p>
    </footer>
</div>
@endsection