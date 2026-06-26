<?php

namespace App\Http\Controllers;
use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::orderBy('date', 'desc')->paginate(15);
        return view('schedule.index', compact('schedules'));
    }

    public function create()
    {
        $schedule = new Schedule();
        return view('schedule.create', compact('schedule'));
    }

    public function store(ScheduleRequest $request)
    {
        Schedule::create($request->validated());
        return redirect()->route('schedules.index')->with('success', 'Horario confirmado');
    }

    public function show(Schedule $schedule)
    {
        return view('schedule.show', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        return view('schedule.edit', compact('schedule'));
    }

    public function update(ScheduleRequest $request, Schedule $schedule)
    {
        $schedule->update($request->validated());
        return redirect()->route('schedules.index')->with('success', 'Horario actualizado');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Horario eliminado');
    }
}
