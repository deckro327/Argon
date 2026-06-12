<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\AreaRequest;
use App\Models\Area;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        return view('area.index');
    }

    public function create (AreaController $request)
    {
    $attendance = new Area();
    return view('area.create', compact('area'));
    }

    public function store(AreaRequest $request)
    {
    Area::create($request->validated());
    return redirect('/area')->with('success', 'area confirmada');
    }

    public function show (Area $area)
    {
        return view('area.show', compact('area'));
    }
//? f en el chat
    public function edit (Area $area)
    {
        $attendance = Area::findOrFail($area);
        return view('area.edit', compact('area'));
    }

    public function update(AreaRequest $request, string $id)
    {
        $area = Area::findOrFail($id);
        $area->update($request->validated());
        return redirect('area.index')->with('success', 'Area acutalizada');
    }

    public function destroy(string $id)
    {
        $area = Area::findOrFail($id);
        $area->delete();
        return redirect('area.index')->with('success','Area eliminada');
    }
}
