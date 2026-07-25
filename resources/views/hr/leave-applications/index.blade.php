@extends('layouts.app')

@section('title', 'Pengajuan Izin Tidak Berangkat')
@section('header_title', 'Pengajuan Izin Tidak Berangkat')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Pengajuan Izin Tidak Berangkat</h2>
            <p class="text-sm text-slate-500 mt-1">Approval dan riwayat pengajuan izin karyawan.</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center">
                <div class="w-12 h-12 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center mr-4">
                    <i data-feather="clock" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Pending</p>
                    <p class="text-xl font-bold text-slate-800 mt-1">{{ $pending ?? 0 }}</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center">
                <div class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center mr-4">
                    <i data-feather="check-circle" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Disetujui</p>
                    <p class="text-xl font-bold text-slate-800 mt-1">{{ $approved ?? 0 }}</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center">
                <div class="w-12 h-12 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center mr-4">
                    <i data-feather="x-circle" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Ditolak</p>
                    <p class="text-xl font-bold text-slate-800 mt-1">{{ $rejected ?? 0 }}</p>
                </div>
            </div>
            <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm flex items-center">
                <div class="w-12 h-12 rounded-lg bg-slate-50 text-slate-600 flex items-center justify-center mr-4">
                    <i data-feather="file-text" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total</p>
                    <p class="text-xl font-bold text-slate-800 mt-1">{{ $total ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Karyawan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Jenis Izin</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal Mulai - Selesai</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Durasi</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Alasan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse($leaveApplications as $item)
                        @php
                            $duration = \Carbon\Carbon::parse($item->start_date)->diffInDays($item->end_date) + 1;
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm mr-3">
                                        {{ strtoupper(substr($item->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold text-slate-800">{{ $item->user->name ?? '-' }}</div>
                                        <div class="text-xs text-slate-500">{{ $item->user->employee_code ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($item->leave_type === 'cuti')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">Cuti</span>
                                @elseif($item->leave_type === 'sakit')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-100 text-rose-800">Sakit</span>
                                @elseif($item->leave_type === 'penting')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">Izin Penting</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-800">Lainnya</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                {{ \Carbon\Carbon::parse($item->start_date)->translatedFormat('d M Y') }} s/d {{ \Carbon\Carbon::parse($item->end_date)->translatedFormat('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-800">
                                {{ $duration }} Hari
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 max-w-xs truncate">
                                {{ Str::limit($item->reason, 50) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($item->status === 'pending')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800 inline-flex items-center">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5 animate-pulse"></span>
                                        Pending
                                    </span>
                                @elseif($item->status === 'approved')
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
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($item->status === 'pending')
                                    <div class="flex items-center gap-1">
                                        <form action="{{ route('hr.leave-applications.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800 hover:bg-emerald-200 transition-colors">
                                                ACC
                                            </button>
                                        </form>
                                        <form action="{{ route('hr.leave-applications.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-100 text-rose-800 hover:bg-rose-200 transition-colors">
                                                REJ
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="flex space-x-2">
                                        <a href="{{ route('hr.leave-applications.show', $item->id) }}" class="text-slate-600 hover:text-indigo-600">
                                            <i data-feather="eye" class="w-4 h-4"></i>
                                        </a>
                                        <form action="{{ route('hr.leave-applications.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus pengajuan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-slate-600 hover:text-red-600">
                                                <i data-feather="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-400 text-sm">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <i data-feather="inbox" class="w-10 h-10 text-slate-300"></i>
                                    <span>Belum ada pengajuan izin.</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($leaveApplications->hasPages())
            <div class="p-4 border-t border-slate-200">
                {{ $leaveApplications->links() }}
            </div>
        @endif
    </div>
</div>
@endsection