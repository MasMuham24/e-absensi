@extends('layouts.app')

@section('title', 'Tambah Jabatan')
@section('header_title', 'Manajemen Jabatan')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-10rem)]">
    <div class="w-full max-w-2xl">
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl font-semibold text-slate-800">Tambah Jabatan Baru</h2>
                <p class="text-sm text-slate-500 mt-1">Masukkan informasi jabatan yang akan ditambahkan.</p>
            </div>
            <a href="{{ route('management.positions.index') }}" class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-slate-900 bg-white border border-slate-300 rounded-lg px-4 py-2.5 shadow-sm hover:bg-slate-50 transition-colors shrink-0">
                <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <form action="{{ route('management.positions.store') }}" method="POST">
                @csrf
                
                <div class="p-6 space-y-6">
                    <!-- Nama Jabatan -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Nama Jabatan <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="block w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2.5 border placeholder-slate-400"
                            placeholder="Contoh: Manager HRD, Staff IT, Supervisor">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Departemen -->
                    <div>
                        <label for="departement_id" class="block text-sm font-medium text-slate-700 mb-1">Departemen <span class="text-red-500">*</span></label>
                        <select name="departement_id" id="departement_id" required
                            class="block w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2.5 border bg-white">
                            <option value="">-- Pilih Departemen --</option>
                            @foreach($departements as $dept)
                                <option value="{{ $dept->id }}" {{ old('departement_id') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('departement_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
                        <textarea name="description" id="description" rows="4"
                            class="block w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-4 py-2.5 border placeholder-slate-400"
                            placeholder="Deskripsi singkat mengenai jabatan ini (opsional)">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex justify-end gap-3">
                    <button type="reset" class="px-4 py-2 bg-white border border-slate-300 rounded-lg shadow-sm text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Reset
                    </button>
                    <button type="submit" class="inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i data-feather="save" class="w-4 h-4 mr-2"></i>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
