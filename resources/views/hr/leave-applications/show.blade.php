@extends('layouts.app')

@section('title', 'Detail Pengajuan Ijin')
@section('header_title', 'Detail Pengajuan Ijin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Karyawan</h3>
                    <p class="text-sm font-medium text-slate-800">{{ $leaveApplication->user->name ?? '-' }}</p>
                    <p class="text-xs text-slate-500">{{ $leaveApplication->user->employee_code ?? '-' }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Jenis Ijin</h3>
                    @if($leaveApplication->leave_type === 'cuti')
                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">Cuti</span>
                    @elseif($leaveApplication->leave_type === 'sakit')
                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-100 text-rose-800">Sakit</span>
                    @elseif($leaveApplication->leave_type === 'penting')
                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">Izin Penting</span>
                    @else
                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-800">Lainnya</span>
                    @endif
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Tanggal</h3>
                    <p class="text-sm text-slate-800">{{ \Carbon\Carbon::parse($leaveApplication->start_date)->translatedFormat('d M Y') }} s/d {{ \Carbon\Carbon::parse($leaveApplication->end_date)->translatedFormat('d M Y') }}</p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Status</h3>
                    @if($leaveApplication->status === 'pending')
                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800 inline-flex items-center">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5 animate-pulse"></span>
                            Pending
                        </span>
                    @elseif($leaveApplication->status === 'approved')
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
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Diterima Oleh</h3>
                    <p class="text-sm text-slate-800">{{ $leaveApplication->approver->name ?? '-' }}</p>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Alasan</h3>
                <p class="text-sm text-slate-600 whitespace-pre-wrap">{{ $leaveApplication->reason }}</p>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('hr.leave-applications.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Kembali
                </a>
                <a href="{{ route('hr.leave-applications.edit', $leaveApplication->id) }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Edit
                </a>
            </div>
        </div>
    </div>
</div>
@endsection