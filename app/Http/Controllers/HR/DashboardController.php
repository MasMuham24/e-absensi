<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Departemen;
use App\Models\LeaveApplication;
use App\Models\LeaveRequest;
use App\Models\Position;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = Carbon::today();

        $pendingLeaveRequestsCount = LeaveRequest::where('status', 'pending')->count();
        $approvedLeaveRequestsCount = LeaveRequest::where('status', 'approved')->count();
        $pendingLeaveApplicationsCount = LeaveApplication::where('status', 'pending')->count();
        $approvedLeaveApplicationsCount = LeaveApplication::where('status', 'approved')->count();
        $activeEmployeesCount = User::where('role', 'employee')->where('status', 'active')->count();
        $usersCount = User::count();
        $positionsCount = Position::count();
        $inactiveUsersCount = User::where('status', '!=', 'active')->count();

        $pendingLeaves = LeaveRequest::with(['user', 'user.department'])->where('status', 'pending')->latest()->take(5)->get();
        $pendingLeaveApplications = LeaveApplication::with(['user', 'user.department'])->where('status', 'pending')->latest()->take(5)->get();
        $lateEmployees = Attendance::with(['user', 'user.department'])->whereDate('attendance_date', $today)->where('status', 'terlambat')->get();

        $departmentsCount = Departemen::count();

        return view('hr.dashboard', compact(
            'pendingLeaveRequestsCount',
            'approvedLeaveRequestsCount',
            'pendingLeaveApplicationsCount',
            'approvedLeaveApplicationsCount',
            'activeEmployeesCount',
            'departmentsCount',
            'usersCount',
            'positionsCount',
            'inactiveUsersCount',
            'pendingLeaves',
            'pendingLeaveApplications',
            'lateEmployees'
        ));
    }
}
