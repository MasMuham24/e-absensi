<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $todayAttendance = Attendance::query()->where('user_id', Auth::id())
            ->whereDate('attendance_date', Carbon::today())
            ->first();

        $attendances = Attendance::query()->where('user_id', Auth::id())
            ->latest('attendance_date')
            ->paginate(10);

        return view('employee.attendance.index', compact('todayAttendance', 'attendances'));
    }

    public function checkIn(Request $request)
    {
        $today = Carbon::today();

        $attendance = Attendance::query()->where('user_id', Auth::id())
            ->whereDate('attendance_date', $today)
            ->first();

        if ($attendance) {
            return back()->with('error', 'You have already checked in today.');
        }

        $now = Carbon::now();
        $officeTime = Carbon::today()->setTime(8, 0);

        $lateMinutes = 0;
        $status = 'hadir';

        if ($now->greaterThan($officeTime)) {
            $lateMinutes = $officeTime->diffInMinutes($now);
            $status = 'terlambat';
        }

        Attendance::create([
            'user_id' => Auth::id(),
            'attendance_date' => $today,
            'check_in' => $now->format('H:i:s'),
            'status' => $status,
            'late_minutes' => $lateMinutes,
        ]);

        return redirect()
            ->route('employee.attendance.index')
            ->with('success', 'Check in successful.');
    }

    public function checkOut(Request $request)
    {
        $attendance = Attendance::query()->where('user_id', Auth::id())
            ->whereDate('attendance_date', Carbon::today())
            ->first();

        if (! $attendance) {
            return back()->with('error', 'You have not checked in today.');
        }

        if ($attendance->check_out) {
            return back()->with('error', 'You have already checked out.');
        }

        $attendance->update([
            'check_out' => Carbon::now()->format('H:i:s'),
        ]);

        return redirect()
            ->route('employee.attendance.index')
            ->with('success', 'Check out successful.');
    }
}
