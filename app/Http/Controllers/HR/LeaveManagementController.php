<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\LeaveApplication;
use App\Models\LeaveRequest;
use Illuminate\View\View;

class LeaveManagementController extends Controller
{
    public function index(): View
    {
        $leaveRequests = LeaveRequest::with(['user', 'approver'])
            ->when(request('status'), function ($query) {
                $query->where('status', request('status'));
            })
            ->latest()
            ->paginate(10);

        $leaveApplications = LeaveApplication::with(['user', 'approver'])
            ->when(request('status'), function ($query) {
                $query->where('status', request('status'));
            })
            ->latest()
            ->paginate(10);

        $pendingCuti = LeaveRequest::where('status', 'pending')->count();
        $approvedCuti = LeaveRequest::where('status', 'approved')->count();
        $rejectedCuti = LeaveRequest::where('status', 'rejected')->count();

        $pendingIzin = LeaveApplication::where('status', 'pending')->count();
        $approvedIzin = LeaveApplication::where('status', 'approved')->count();
        $rejectedIzin = LeaveApplication::where('status', 'rejected')->count();

        return view('hr.leave-management.index', compact(
            'leaveRequests', 'leaveApplications',
            'pendingCuti', 'approvedCuti', 'rejectedCuti',
            'pendingIzin', 'approvedIzin', 'rejectedIzin'
        ));
    }
}