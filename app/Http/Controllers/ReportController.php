<?php

namespace App\Http\Controllers;
use App\Http\Requests\ReportRequest;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        return view('report.index');
    }

    public function create (ReportController $request)
    {
    $attendance = new Report();
    return view('report.create', compact('report'));
    }

    public function store(ReportRequest $request)
    {
    Report::create($request->validated());
    return redirect('/report')->with('success', 'reporte confirmada');
    }

    public function show (Report $report)
    {
        return view('report.show', compact('report'));
    }
//? f en el chat
    public function edit (Report $report)
    {
        $attendance = Report::findOrFail($report);
        return view('report.edit', compact('report'));
    }

    public function update(ReportRequest $request, string $id)
    {
        $report = Report::findOrFail($id);
        $report->update($request->validated());
        return redirect('report.index')->with('success', 'Reporte acutalizada');
    }

    public function destroy(string $id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return redirect('report.index')->with('success','reporte eliminado');
    }
}


