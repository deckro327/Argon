<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $attendanceRecords = Attendance::all();

        $hoursWorked = round($attendanceRecords->sum(function ($attendance) {
            if (!$attendance->punctuality || !$attendance->departure) {
                return 0;
            }

            $punctuality = Carbon::parse($attendance->punctuality);
            $departure = Carbon::parse($attendance->departure);

            return max(0, $punctuality->diffInMinutes($departure)) / 60;
        }), 2);

        $attendanceCount = Attendance::all()->count();
        $absenceCount = Attendance::all()->where('status', 'ausente')->count();
        $workersCount = Worker::all()->count();

        return view('dashboard', compact('hoursWorked', 'attendanceCount', 'absenceCount', 'workersCount'));
    }
}