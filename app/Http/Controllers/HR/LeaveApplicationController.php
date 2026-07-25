<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeaveApplication\StoreLeaveApplicationRequest;
use App\Http\Requests\LeaveApplication\UpdateLeaveApplicationRequest;
use App\Models\LeaveApplication;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LeaveApplicationController extends Controller
{
    public function index(): View
    {
        $leaveApplications = LeaveApplication::with(['user', 'approver'])
            ->when(request('status'), function ($query) {
                $query->where('status', request('status'));
            })
            ->when(request('leave_type'), function ($query) {
                $query->where('leave_type', request('leave_type'));
            })
            ->latest()
            ->paginate(10);

        $pending = LeaveApplication::where('status', 'pending')->count();
        $approved = LeaveApplication::where('status', 'approved')->count();
        $rejected = LeaveApplication::where('status', 'rejected')->count();
        $total = LeaveApplication::count();

        return view('hr.leave-applications.index', compact('leaveApplications', 'pending', 'approved', 'rejected', 'total'));
    }

    public function create(): View
    {
        $users = User::where('role', 'employee')->get();
        return view('hr.leave-applications.create', compact('users'));
    }

    public function store(StoreLeaveApplicationRequest $request): RedirectResponse
    {
        LeaveApplication::create($request->validated());

        return redirect()
            ->route('hr.leave-applications.index')
            ->with('success', 'Pengajuan ijin berhasil dibuat.');
    }

    public function show(string $id): View
    {
        $leaveApplication = LeaveApplication::with(['user', 'approver'])->findOrFail($id);
        return view('hr.leave-applications.show', compact('leaveApplication'));
    }

    public function edit(string $id): View
    {
        $leaveApplication = LeaveApplication::with(['user', 'approver'])->findOrFail($id);
        $users = User::where('role', 'employee')->get();
        return view('hr.leave-applications.edit', compact('leaveApplication', 'users'));
    }

    public function update(UpdateLeaveApplicationRequest $request, string $id): RedirectResponse
    {
        $leaveApplication = LeaveApplication::findOrFail($id);
        $data = $request->validated();

        if ($request->has('status') && in_array($request->status, ['approved', 'rejected'])) {
            $data['approved_by'] = auth()->id();
            $data['approved_at'] = now();
        }

        $leaveApplication->update($data);

        return redirect()
            ->route('hr.leave-applications.index')
            ->with('success', 'Pengajuan ijin berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $leaveApplication = LeaveApplication::findOrFail($id);
        $leaveApplication->delete();

        return redirect()
            ->route('hr.leave-applications.index')
            ->with('success', 'Pengajuan ijin berhasil dihapus.');
    }
}