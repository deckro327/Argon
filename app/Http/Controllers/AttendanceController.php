<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        return view('attendance.index');
    }

        public function create (Request $request)
        {
        $attendance = new Attendance();
        return view('attendance.create', compact('attendance'));
        }

    public function store(AttendanceRequest $request)
    {
        Attendance::create($request->validated());
        return redirect('/attendance')->with('success', 'asistencia confirmada');
    }

    public function show (Attendance $attendance)
    {
        return view('attendance.show', compact('attendance'));
    }

    public function edit (Attendance $attendance)
    {
        $attendance = Attendance::findOrFail($attendance);
        return view('attendance.edit', compact('attendance'));
    }

    public function update(AttendanceRequest $request, string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->update($request->validated());
        return redirect('attendance.index')->with('success', 'asistencia actualizada');
    }

    public function destroy(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        return redirect('attendance.index')->with('success','asistencia eliminada');
    }
}

