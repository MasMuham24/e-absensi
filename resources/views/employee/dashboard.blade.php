@extends('layouts.app')

@section('title', 'Dashboard Karyawan')
@section('header_title', 'Dashboard Karyawan')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                <i data-feather="calendar" class="w-6 h-6"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-slate-500">Kehadiran Bulan Ini</h3>
                <p class="text-2xl font-bold text-slate-800">{{ $attendanceThisMonth }} Hari</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-100 text-red-600">
                <i data-feather="alert-circle" class="w-6 h-6"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-slate-500">Terlambat Bulan Ini</h3>
                <p class="text-2xl font-bold text-slate-800">{{ $lateThisMonth }} Kali</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i data-feather="sun" class="w-6 h-6"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-slate-500">Sisa Cuti</h3>
                <p class="text-2xl font-bold text-slate-800">12 Hari</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
        <div class="p-6 border-b border-slate-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-slate-800">Presensi Hari Ini</h2>
            @if($todayAttendance)
                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-semibold rounded-full uppercase">
                    Status: {{ $todayAttendance->status }}
                </span>
            @else
                <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-semibold rounded-full">
                    Belum Absen
                </span>
            @endif
        </div>
        <div class="p-6 space-y-4">
            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg border border-slate-100">
                <div class="flex items-center">
                    <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg mr-4">
                        <i data-feather="log-in" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-800">Jam Masuk</p>
                        <p class="text-xs text-slate-500">{{ $todayAttendance->check_in ?? 'Belum Check In' }}</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg border border-slate-100">
                <div class="flex items-center">
                    <div class="p-2 bg-slate-200 text-slate-600 rounded-lg mr-4">
                        <i data-feather="log-out" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-800">Jam Keluar</p>
                        <p class="text-xs text-slate-500">{{ $todayAttendance->check_out ?? 'Belum Check Out' }}</p>
                    </div>
                </div>
                <a href="{{ route('employee.attendance.index') }}" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                    Kelola Absensi
                </a>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
        <div class="p-6 border-b border-slate-200">
            <h2 class="text-lg font-semibold text-slate-800">Riwayat Kehadiran Terakhir</h2>
        </div>
        <div class="p-6">
            @if($recentAttendances->count() > 0)
                <div class="space-y-3">
                    @foreach($recentAttendances as $att)
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-100 text-sm">
                            <span class="font-medium text-slate-800">{{ \Carbon\Carbon::parse($att->attendance_date)->translatedFormat('d M Y') }}</span>
                            <span class="text-slate-600">{{ $att->check_in ?? '-' }} s/d {{ $att->check_out ?? '-' }}</span>
                            @if($att->status === 'terlambat')
                                <span class="px-2 py-0.5 text-2xs font-semibold rounded-full bg-amber-100 text-amber-800">Terlambat</span>
                            @else
                                <span class="px-2 py-0.5 text-2xs font-semibold rounded-full bg-emerald-100 text-emerald-800">Hadir</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-slate-400 text-center py-6">Belum ada riwayat kehadiran.</p>
            @endif
        </div>
    </div>
</div>
@endsection
