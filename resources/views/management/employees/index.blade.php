@extends('layouts.app')

@section('title', 'Data Karyawan')
@section('header_title', 'Manajemen Karyawan')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <h2 class="text-xl font-semibold text-slate-800">Daftar Karyawan</h2>
        <p class="text-sm text-slate-500 mt-1">Kelola data karyawan di perusahaan.</p>
    </div>
    
    <div>
        <a href="{{ route('management.employees.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-colors w-full sm:w-auto">
            <i data-feather="plus" class="w-4 h-4 mr-2"></i>
            Tambah Karyawan
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-4 border-b border-slate-200 bg-slate-50/50">
        <form method="GET" action="{{ route('management.employees.index') }}" class="flex flex-col sm:flex-row sm:items-center gap-3">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                    <i data-feather="search" class="w-4 h-4"></i>
                </div>
                <input type="text" name="search" value="{{ $search ?? '' }}" class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm placeholder-slate-400" placeholder="Cari nama, kode, username...">
            </div>

            <div class="flex flex-col sm:flex-row gap-3">
                <select name="departement_id" class="block w-full sm:w-48 border border-slate-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2 bg-white">
                    <option value="">Semua Departemen</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ ($departementId ?? '') == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                    @endforeach
                </select>

                <select name="status" class="block w-full sm:w-36 border border-slate-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-sm px-3 py-2 bg-white">
                    <option value="">Semua Status</option>
                    <option value="active" {{ ($status ?? '') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ ($status ?? '') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>

                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    <i data-feather="filter" class="w-4 h-4 mr-2"></i>
                    Filter
                </button>

                @if($search || $departementId || $status)
                    <a href="{{ route('management.employees.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        <i data-feather="x" class="w-4 h-4 mr-1"></i>
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                    <th class="px-6 py-4">No</th>
                    <th class="px-6 py-4">Kode</th>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Username</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Departemen</th>
                    <th class="px-6 py-4">Jabatan</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 text-sm text-slate-700">
                @forelse($employees as $index => $emp)
                <tr class="hover:bg-slate-50/50 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $employees->firstItem() + $index }}</td>
                    <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-800">{{ $emp->employee_code }}</td>
                    <td class="px-6 py-4 whitespace-nowrap font-medium text-slate-800">{{ $emp->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $emp->username }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $emp->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2.5 py-1 text-xs font-medium bg-slate-100 text-slate-800 rounded-md">
                            {{ $emp->department->name ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2.5 py-1 text-xs font-medium bg-indigo-50 text-indigo-700 rounded-md">
                            {{ $emp->position->name ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($emp->status === 'active')
                            <span class="px-2.5 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-md">Aktif</span>
                        @else
                            <span class="px-2.5 py-1 text-xs font-medium bg-red-100 text-red-700 rounded-md">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center justify-end">
                            <a href="{{ route('management.employees.edit', $emp->id) }}" class="text-indigo-600 hover:text-indigo-900 mx-1 bg-indigo-50 p-2 rounded-md hover:bg-indigo-100 transition-colors" title="Edit">
                                <i data-feather="edit-2" class="w-4 h-4"></i>
                            </a>
                            <form action="{{ route('management.employees.destroy', $emp->id) }}" method="POST" class="inline-block m-0 p-0 delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="text-red-600 hover:text-red-900 mx-1 bg-red-50 p-2 rounded-md hover:bg-red-100 transition-colors" title="Hapus">
                                    <i data-feather="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-6 py-10 text-center text-slate-500">
                        <div class="flex flex-col items-center justify-center">
                            <i data-feather="inbox" class="w-10 h-10 text-slate-300 mb-3"></i>
                            <p>Belum ada data karyawan.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($employees->hasPages())
    <div class="p-4 border-t border-slate-200 bg-slate-50">
        {{ $employees->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.querySelector('button').addEventListener('click', function () {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data karyawan yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush