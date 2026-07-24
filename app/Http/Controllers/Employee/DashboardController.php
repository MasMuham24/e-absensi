<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $userId = Auth::id();
        $today = Carbon::today();
        $now = Carbon::now();

        $attendanceThisMonth = Attendance::where('user_id', $userId)
            ->whereMonth('attendance_date', $now->month)
            ->whereYear('attendance_date', $now->year)
            ->count();

        $lateThisMonth = Attendance::where('user_id', $userId)
            ->whereMonth('attendance_date', $now->month)
            ->whereYear('attendance_date', $now->year)
            ->where('status', 'terlambat')
            ->count();

        $todayAttendance = Attendance::where('user_id', $userId)
            ->whereDate('attendance_date', $today)
            ->first();

        $recentAttendances = Attendance::where('user_id', $userId)
            ->latest('attendance_date')
            ->take(5)
            ->get();

        return view('employee.dashboard', compact(
            'attendanceThisMonth',
            'lateThisMonth',
            'todayAttendance',
            'recentAttendances'
        ));
    }
}
