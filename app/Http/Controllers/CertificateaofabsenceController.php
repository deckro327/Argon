<?php

namespace App\Http\Controllers;

use App\Http\Requests\CertificateOfAbsenceRequest;
use App\Models\Certificateaofabsence;
use Illuminate\Http\Request;

class CertificateaofabsenceController extends Controller
{
    public function index(Request $request)
    {
        return view('certificateaofabsence.index');
    }

    public function create()
    {
        $certificateaofabsence = new Certificateaofabsence();
        return view('certificateaofabsence.create', compact('certificateaofabsence'));
    }

    public function store(CertificateOfAbsenceRequest $request)
    {
        Certificateaofabsence::create($request->validated());
        return redirect('/certificateaofabsence')->with('success', 'area confirmada');
    }

    public function show (Certificateaofabsence $certificateaofabsence)
    {
        return view('certificateaofabsence.show', compact('certificateaofabsence'));
    }

    public function edit (Certificateaofabsence $certificateaofabsence)
    {
        $certificateaofabsence = Certificateaofabsence::findOrFail($certificateaofabsence);
        return view('certificateaofabsence.edit', compact('certificateaofabsence'));
    }

    public function update(CertificateOfAbsenceRequest $request, string $id)
    {
        $certificateaofabsence = Certificateaofabsence::findOrFail($id);
        $certificateaofabsence->update($request->validated());
        return redirect('certificateaofabsence.index')->with('success', 'Area acutalizada');
    }

    public function destroy(string $id)
    {
        $certificateaofabsence = Certificateaofabsence::findOrFail($id);
        $certificateaofabsence->delete();
        return redirect('certificateaofabsence.index')->with('success','Area eliminada');
    }
}
