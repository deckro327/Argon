<?php

namespace App\Http\Controllers;
use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        return view('schedule.index');
    }

    public function create (ScheduleController $request)
    {
    $attendance = new Schedule();
    return view('schedule.create', compact('schedule'));
    }

    public function store(ScheduleRequest $request)
    {
    Schedule::create($request->validated());
    return redirect('/schedule')->with('success', 'horario confirmado');
    }

    public function show (Schedule $schedule)
    {
        return view('schedule.show', compact('schedule'));
    }
//? f en el chat
    public function edit (Schedule $schedule)
    {
        $attendance = Schedule::findOrFail($schedule);
        return view('schedule.edit', compact('schedule'));
    }

    public function update(ScheduleRequest $request, string $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->validated());
        return redirect('schedule.index')->with('success', 'horario acutalizado');
    }

    public function destroy(string $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return redirect('schedule.index')->with('success','horario eliminado');
    }
}
