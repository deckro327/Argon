<?php

namespace App\Http\Controllers;
use App\Models\Absence;
use App\Http\Requests\AbsenceRequest;
use Illuminate\Http\Request;


class AbsenceController extends Controller
{
    public function index(Request $request)
    {
        return view('absence.index');
    }

    public function create (AbsenceController $request)
    {
    $attendance = new Absence();
    return view('absence.create', compact('absence'));
    }

    public function store(AbsenceRequest $request)
    {
    Absence::create($request->validated());
    return redirect('/absence')->with('success', 'horario confirmado');
    }

    public function show (Absence $absence)
    {
        return view('absence.show', compact('absence'));
    }
//? f en el chat
    public function edit (Absence $absence)
    {
        $attendance = Absence::findOrFail($absence);
        return view('absence.edit', compact('absence'));
    }

    public function update(AbsenceRequest $request, string $id)
    {
        $absence = Absence::findOrFail($id);
        $absence->update($request->validated());
        return redirect('absence.index')->with('success', 'horario acutalizado');
    }

    public function destroy(string $id)
    {
        $absence = Absence::findOrFail($id);
        $absence->delete();
        return redirect('absence.index')->with('success','horario eliminado');
    }
}
