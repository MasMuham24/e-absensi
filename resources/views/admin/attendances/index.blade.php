@extends('layouts.app')

@section('title', 'Rekap Absensi Karyawan')
@section('header_title', 'Manajemen Absensi')

@section('content')
<div class="space-y-6">
    <!-- Header & Filter -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div>
                <h2 class="text-xl font-semibold text-slate-800">Rekap Absensi Karyawan</h2>
                <p class="text-sm text-slate-500 mt-1">Pantau kehadiran, jam masuk, jam keluar, dan status keterlambatan seluruh karyawan.</p>
            </div>
        </div>

        <!-- Filter Form -->
        <form action="{{ route('admin.attendances.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Cari Karyawan</label>
                <input type="text" name="search" id="search" value="{{ $search ?? '' }}" placeholder="Nama / Kode / Username"
                    class="block w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3.5 py-2 border placeholder-slate-400">
            </div>

            <!-- Date -->
            <div>
                <label for="date" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tanggal</label>
                <input type="date" name="date" id="date" value="{{ $date ?? '' }}"
                    class="block w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3.5 py-2 border bg-white">
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Status</label>
                <select name="status" id="status"
                    class="block w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3.5 py-2 border bg-white">
                    <option value="">-- Semua Status --</option>
                    <option value="hadir" {{ ($status ?? '') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                    <option value="terlambat" {{ ($status ?? '') == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
                    <option value="cuti" {{ ($status ?? '') == 'cuti' ? 'selected' : '' }}>Cuti</option>
                    <option value="sakit" {{ ($status ?? '') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="alpha" {{ ($status ?? '') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                </select>
            </div>

            <!-- Department -->
            <div>
                <label for="departement_id" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Departemen</label>
                <select name="departement_id" id="departement_id"
                    class="block w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3.5 py-2 border bg-white">
                    <option value="">-- Semua Departemen --</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ ($departementId ?? '') == $dept->id ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Actions -->
            <div class="flex items-end space-x-2">
                <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-colors">
                    Filter
                </button>
                <a href="{{ route('admin.attendances.index') }}" class="inline-flex items-center justify-center px-3 py-2 bg-white border border-slate-300 rounded-lg font-medium text-sm text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors" title="Reset Filter">
                    <i data-feather="rotate-ccw" class="w-4 h-4"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Karyawan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Departemen / Jabatan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Jam Masuk</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Jam Keluar</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Keterlambatan</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-200">
                    @forelse($attendances as $att)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold text-sm mr-3">
                                        {{ strtoupper(substr($att->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold text-slate-800">{{ $att->user->name ?? '-' }}</div>
                                        <div class="text-xs text-slate-500">{{ $att->user->employee_code ?? '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                <div class="font-medium text-slate-800">{{ $att->user->department->name ?? '-' }}</div>
                                <div class="text-xs text-slate-500">{{ $att->user->position->name ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-800">
                                {{ \Carbon\Carbon::parse($att->attendance_date)->translatedFormat('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                {{ $att->check_in ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                {{ $att->check_out ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                @if($att->status === 'terlambat')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-amber-100 text-amber-800">
                                        Terlambat
                                    </span>
                                @elseif($att->status === 'hadir')
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-emerald-100 text-emerald-800">
                                        Hadir
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-slate-100 text-slate-800">
                                        {{ ucfirst($att->status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                @if($att->late_minutes > 0)
                                    <span class="text-amber-600 font-medium">{{ $att->late_minutes }} menit</span>
                                @else
                                    <span class="text-slate-400">Tepat waktu</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-400 text-sm">
                                Tidak ada data absensi yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($attendances->hasPages())
            <div class="p-4 border-t border-slate-200">
                {{ $attendances->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
