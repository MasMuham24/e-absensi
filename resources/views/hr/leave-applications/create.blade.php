@extends('layouts.app')

@section('title', 'Buat Pengajuan Ijin')
@section('header_title', 'Buat Pengajuan Ijin Tidak Berangkat')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <form action="{{ route('hr.leave-applications.store') }}" method="POST">
            @csrf

            <div class="space-y-6">
                <div>
                    <label for="user_id" class="block text-sm font-medium text-slate-700 mb-2">Karyawan</label>
                    <select name="user_id" id="user_id" required class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3.5 py-2 border">
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->employee_code }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="leave_type" class="block text-sm font-medium text-slate-700 mb-2">Jenis Ijin</label>
                    <select name="leave_type" id="leave_type" required class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3.5 py-2 border">
                        <option value="">-- Pilih Jenis Ijin --</option>
                        <option value="cuti">Cuti</option>
                        <option value="sakit">Sakit</option>
                        <option value="penting">Izin Penting</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-slate-700 mb-2">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="start_date" required class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3.5 py-2 border">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-slate-700 mb-2">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="end_date" required class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3.5 py-2 border">
                    </div>
                </div>

                <div>
                    <label for="reason" class="block text-sm font-medium text-slate-700 mb-2">Alasan</label>
                    <textarea name="reason" id="reason" rows="4" required class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3.5 py-2 border resize-y"></textarea>
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('hr.leave-applications.index') }}" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex justify-center px-4 py-2.5 text-sm font-semibold rounded-xl text-white bg-indigo-600 border border-transparent hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg shadow-indigo-600/20 transition-all transform hover:-translate-y-0.5">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection