<?php

namespace App\Http\Controllers;
use App\Models\Absence;
use Illuminate\Http\Request;


class AbsenceController extends Controller
{
    public function index(Request $request)
    {
        return view('absence.index');
    }

        public function create (Request $request)
        {
        $absence = new AbsenceController();
        return view('attendance.create', compact('absence'));
        }

    public function store(AbsenceController $request)
    {
        Absence::create($request->validated());
        return redirect('/absence')->with('success', 'asistencia confirmada');
    }

    public function show (AbsenceController $absence)
    {
        return view('absence.show', compact('absence'));
    }

    public function edit (AbsenceController $absence)
    {
        $absence = Absence::findOrFail($absence);
        return view('absence.edit', compact('absence'));
    }

    public function update(AbsenceController $request, string $id)
    {
        $absence = Absence::findOrFail($id);
        $absence->update($request->validated());
        return redirect('absence.index')->with('success', 'asistencia actualizada');
    }

    public function destroy(string $id)
    {
        $absence = Absence::findOrFail($id);
        $absence->delete();
        return redirect('absence.index')->with('success','asistencia eliminada');
    }
}
