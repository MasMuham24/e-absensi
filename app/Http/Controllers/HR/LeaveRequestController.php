<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeaveRequestController extends Controller
{
    public function index(): View
    {
        $leaveRequests = LeaveRequest::with(['user', 'approver'])
            ->when(request('status'), function ($query) {
                $query->where('status', request('status'));
            })
            ->when(request('leave_type'), function ($query) {
                $query->where('leave_type', request('leave_type'));
            })
            ->latest()
            ->paginate(10);

        $pending = LeaveRequest::where('status', 'pending')->count();
        $approved = LeaveRequest::where('status', 'approved')->count();
        $rejected = LeaveRequest::where('status', 'rejected')->count();
        $total = LeaveRequest::count();

        return view('hr.leave-requests.index', compact('leaveRequests', 'pending', 'approved', 'rejected', 'total'));
    }

    public function show(string $id): View
    {
        $leaveRequest = LeaveRequest::with(['user', 'approver'])->findOrFail($id);
        return view('hr.leave-requests.show', compact('leaveRequest'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:approved,rejected'],
        ]);

        $leaveRequest = LeaveRequest::findOrFail($id);

        $leaveRequest->update([
            'status' => $validated['status'],
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        return redirect()
            ->route('hr.leave-requests.index')
            ->with('success', 'Pengajuan cuti ' . ($validated['status'] === 'approved' ? 'disetujui' : 'ditolak') . '.');
    }
}