<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = Carbon::today();

        $pendingLeavesCount = LeaveRequest::where('status', 'pending')->count();
        $approvedLeavesCount = LeaveRequest::where('status', 'approved')->count();
        $activeEmployeesCount = User::where('role', 'employee')->where('status', 'active')->count();

        $pendingLeaves = LeaveRequest::with(['user', 'user.department'])->where('status', 'pending')->latest()->take(5)->get();
        $lateEmployees = Attendance::with(['user', 'user.department'])->whereDate('attendance_date', $today)->where('status', 'terlambat')->get();

        return view('hr.dashboard', compact(
            'pendingLeavesCount',
            'approvedLeavesCount',
            'activeEmployeesCount',
            'pendingLeaves',
            'lateEmployees'
        ));
    }
}
