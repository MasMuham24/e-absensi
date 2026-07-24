@extends('layouts.app')

@section('title', 'Dashboard HR')
@section('header_title', 'Dashboard HR')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                <i data-feather="file-text" class="w-6 h-6"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-slate-500">Pengajuan Cuti Menunggu</h3>
                <p class="text-2xl font-bold text-slate-800">{{ $pendingLeavesCount }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-green-100 text-green-600">
                <i data-feather="check-circle" class="w-6 h-6"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-slate-500">Cuti Disetujui</h3>
                <p class="text-2xl font-bold text-slate-800">{{ $approvedLeavesCount }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                <i data-feather="users" class="w-6 h-6"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-slate-500">Karyawan Aktif</h3>
                <p class="text-2xl font-bold text-slate-800">{{ $activeEmployeesCount }}</p>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
        <div class="p-6 border-b border-slate-200">
            <h2 class="text-lg font-semibold text-slate-800">Pengajuan Cuti Menunggu Persetujuan</h2>
        </div>
        <div class="p-6">
            @if($pendingLeaves->count() > 0)
                <div class="space-y-4">
                    @foreach($pendingLeaves as $leave)
                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg border border-slate-100">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">{{ $leave->user->name ?? '-' }}</p>
                                <p class="text-xs text-slate-500">{{ ucfirst($leave->leave_type) }} ({{ $leave->start_date->format('d M') }} - {{ $leave->end_date->format('d M') }})</p>
                            </div>
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">Pending</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-slate-400 text-center py-6">Tidak ada pengajuan cuti tertunda.</p>
            @endif
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200">
        <div class="p-6 border-b border-slate-200">
            <h2 class="text-lg font-semibold text-slate-800">Karyawan Terlambat Hari Ini</h2>
        </div>
        <div class="p-6">
            @if($lateEmployees->count() > 0)
                <div class="space-y-4">
                    @foreach($lateEmployees as $att)
                        <div class="flex items-center justify-between p-4 bg-slate-50 rounded-lg border border-slate-100">
                            <div>
                                <p class="text-sm font-semibold text-slate-800">{{ $att->user->name ?? '-' }}</p>
                                <p class="text-xs text-slate-500">Jam Masuk: {{ $att->check_in }}</p>
                            </div>
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">Terlambat {{ $att->late_minutes }} mnt</span>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-slate-400 text-center py-6">Tidak ada karyawan yang terlambat hari ini.</p>
            @endif
        </div>
    </div>
</div>
@endsection
