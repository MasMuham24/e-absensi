@extends('layouts.app')

@section('title', 'Pengajuan Cuti / Izin')
@section('header_title', 'Pengajuan Cuti & Izin')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <!-- Header Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-800 animate__animated animate__fadeInLeft">Daftar Pengajuan Cuti & Izin</h2>
            <p class="text-sm text-slate-500 mt-0.5 animate__animated animate__fadeInLeft">Kelola dan pantau status permohonan cuti atau izin Anda.</p>
        </div>
        <div class="animate__animated animate__fadeInRight">
            <a href="{{ route('employee.leave-requests.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 border border-transparent rounded-xl font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg shadow-indigo-600/20 transition-all transform hover:-translate-y-0.5">
                <i data-feather="plus" class="w-5 h-5 mr-2"></i>
                Buat Pengajuan Baru
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 animate__animated animate__fadeIn">
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center">
            <div class="w-12 h-12 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center mr-4">
                <i data-feather="file-text" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Pengajuan</p>
                <p class="text-xl font-bold text-slate-800 mt-1">{{ $leaveRequests->total() }}</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center">
            <div class="w-12 h-12 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center mr-4">
                <i data-feather="clock" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Pending</p>
                <p class="text-xl font-bold text-slate-800 mt-1">{{ $totalPending }}</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center">
            <div class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center mr-4">
                <i data-feather="check-circle" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Disetujui</p>
                <p class="text-xl font-bold text-slate-800 mt-1">{{ $totalApproved }}</p>
            </div>
        </div>
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center">
            <div class="w-12 h-12 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center mr-4">
                <i data-feather="x-circle" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Ditolak</p>
                <p class="text-xl font-bold text-slate-800 mt-1">{{ $totalRejected }}</p>
            </div>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden animate__animated animate__fadeInUp">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Pengajuan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Jenis Pengajuan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Rentang Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Durasi</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Alasan / Keterangan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse($leaveRequests as $req)
                        @php
                            $start = \Carbon\Carbon::parse($req->start_date);
                            $end = \Carbon\Carbon::parse($req->end_date);
                            $duration = $start->diffInDays($end) + 1;
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-800">
                                {{ $req->created_at->translatedFormat('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($req->leave_type === 'cuti')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                        Cuti
                                    </span>
                                @elseif($req->leave_type === 'sakit')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-100 text-rose-800">
                                        Sakit
                                    </span>
                                @elseif($req->leave_type === 'penting')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">
                                        Izin Penting
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-800">
                                        Lainnya
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                {{ $start->translatedFormat('d M Y') }} s/d {{ $end->translatedFormat('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 font-medium">
                                {{ $duration }} Hari
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 max-w-xs truncate">
                                {{ $req->reason }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($req->status === 'pending')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800 inline-flex items-center">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5 animate-pulse"></span>
                                        Pending
                                    </span>
                                @elseif($req->status === 'approved')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800 inline-flex items-center">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                                        Disetujui
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-100 text-rose-800 inline-flex items-center">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500 mr-1.5"></span>
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 text-sm">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <i data-feather="inbox" class="w-10 h-10 text-slate-300"></i>
                                    <span>Belum ada riwayat pengajuan cuti atau izin.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($leaveRequests->hasPages())
            <div class="p-4 border-t border-slate-200">
                {{ $leaveRequests->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
