@extends('layouts.app')

@section('title', 'Buat Pengajuan Cuti / Izin')
@section('header_title', 'Buat Pengajuan Baru')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Header with Back Button -->
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-800 animate__animated animate__fadeInLeft">Form Pengajuan Cuti & Izin</h2>
            <p class="text-sm text-slate-500 mt-0.5 animate__animated animate__fadeInLeft">Silakan isi formulir di bawah ini dengan lengkap dan benar.</p>
        </div>
        <div class="animate__animated animate__fadeInRight">
            <a href="{{ route('employee.leave-requests.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-slate-300 rounded-xl font-semibold text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden animate__animated animate__fadeInUp" x-data="leaveForm()">
        <form action="{{ route('employee.leave-requests.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf

            <!-- Leave Type -->
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700">Jenis Pengajuan <span class="text-rose-500">*</span></label>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <label class="relative flex flex-col items-center justify-center p-4 border rounded-xl cursor-pointer hover:bg-slate-50 transition-colors text-center" :class="leave_type === 'cuti' ? 'border-indigo-500 bg-indigo-50/50 text-indigo-700' : 'border-slate-200 text-slate-600'">
                        <input type="radio" name="leave_type" value="cuti" class="sr-only" x-model="leave_type" required>
                        <i data-feather="calendar" class="w-6 h-6 mb-2"></i>
                        <span class="text-sm font-semibold">Cuti Tahunan</span>
                    </label>

                    <label class="relative flex flex-col items-center justify-center p-4 border rounded-xl cursor-pointer hover:bg-slate-50 transition-colors text-center" :class="leave_type === 'sakit' ? 'border-rose-500 bg-rose-50/50 text-rose-700' : 'border-slate-200 text-slate-600'">
                        <input type="radio" name="leave_type" value="sakit" class="sr-only" x-model="leave_type">
                        <i data-feather="activity" class="w-6 h-6 mb-2"></i>
                        <span class="text-sm font-semibold">Sakit</span>
                    </label>

                    <label class="relative flex flex-col items-center justify-center p-4 border rounded-xl cursor-pointer hover:bg-slate-50 transition-colors text-center" :class="leave_type === 'penting' ? 'border-amber-500 bg-amber-50/50 text-amber-700' : 'border-slate-200 text-slate-600'">
                        <input type="radio" name="leave_type" value="penting" class="sr-only" x-model="leave_type">
                        <i data-feather="alert-circle" class="w-6 h-6 mb-2"></i>
                        <span class="text-sm font-semibold">Izin Penting</span>
                    </label>

                    <label class="relative flex flex-col items-center justify-center p-4 border rounded-xl cursor-pointer hover:bg-slate-50 transition-colors text-center" :class="leave_type === 'lainnya' ? 'border-slate-500 bg-slate-100 text-slate-700' : 'border-slate-200 text-slate-600'">
                        <input type="radio" name="leave_type" value="lainnya" class="sr-only" x-model="leave_type">
                        <i data-feather="file-text" class="w-6 h-6 mb-2"></i>
                        <span class="text-sm font-semibold">Lainnya</span>
                    </label>
                </div>
                @error('leave_type')
                    <p class="text-sm text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date Range -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Start Date -->
                <div class="space-y-2">
                    <label for="start_date" class="block text-sm font-semibold text-slate-700">Tanggal Mulai <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <i data-feather="calendar" class="w-5 h-5"></i>
                        </div>
                        <input type="date" id="start_date" name="start_date" x-model="start_date" @change="calculateDuration" class="pl-10 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-slate-800" required>
                    </div>
                    @error('start_date')
                        <p class="text-sm text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- End Date -->
                <div class="space-y-2">
                    <label for="end_date" class="block text-sm font-semibold text-slate-700">Tanggal Selesai <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                            <i data-feather="calendar" class="w-5 h-5"></i>
                        </div>
                        <input type="date" id="end_date" name="end_date" x-model="end_date" @change="calculateDuration" class="pl-10 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-slate-800" :min="start_date" required>
                    </div>
                    @error('end_date')
                        <p class="text-sm text-rose-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Duration Indicator -->
            <div x-show="duration > 0" class="p-4 bg-indigo-50 border border-indigo-100 rounded-xl text-sm text-indigo-800 flex items-center animate__animated animate__fadeIn">
                <i data-feather="info" class="w-5 h-5 mr-2 flex-shrink-0 text-indigo-600"></i>
                <span>Pengajuan ini terhitung selama <strong x-text="duration"></strong> hari kerja.</span>
            </div>

            <!-- Reason / Description -->
            <div class="space-y-2">
                <label for="reason" class="block text-sm font-semibold text-slate-700">Alasan / Keterangan Pengajuan <span class="text-rose-500">*</span></label>
                <textarea id="reason" name="reason" rows="4" placeholder="Tuliskan alasan pengajuan secara jelas..." class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-slate-800" required></textarea>
                @error('reason')
                    <p class="text-sm text-rose-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end space-x-3">
                <a href="{{ route('employee.leave-requests.index') }}" class="px-5 py-2.5 border border-slate-200 rounded-xl text-sm font-semibold text-slate-600 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    Batalkan
                </a>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 border border-transparent rounded-xl text-sm font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg shadow-indigo-600/20 transition-all transform hover:-translate-y-0.5">
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function leaveForm() {
        return {
            leave_type: 'cuti',
            start_date: '',
            end_date: '',
            duration: 0,
            calculateDuration() {
                if (this.start_date && this.end_date) {
                    const start = new Date(this.start_date);
                    const end = new Date(this.end_date);
                    if (end >= start) {
                        const timeDiff = end.getTime() - start.getTime();
                        this.duration = Math.floor(timeDiff / (1000 * 3600 * 24)) + 1;
                    } else {
                        this.duration = 0;
                    }
                } else {
                    this.duration = 0;
                }
            }
        }
    }
</script>
@endpush
@endsection
