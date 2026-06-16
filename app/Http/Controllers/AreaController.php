<?php

namespace App\Http\Controllers;

use App\Http\Requests\AreaRequest;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $areas = Area::query()->paginate(10);

        return view('area.index', compact('areas'))
            ->with('i', (request()->input('page', 1) - 1) * $areas->perPage());
    }

    public function create()
    {
        $area = new Area();

        return view('area.create', compact('area'));
    }

    public function store(AreaRequest $request)
    {
        Area::create($request->validated());

        return redirect()->route('areas.index')->with('success', 'Area confirmada');
    }

    public function show(Area $area)
    {
        $area->load('workers');

        return view('area.show', compact('area'));
    }

    public function edit(Area $area)
    {
        return view('area.edit', compact('area'));
    }

    public function update(AreaRequest $request, Area $area)
    {
        $area->update($request->validated());

        return redirect()->route('areas.index')->with('success', 'Area actualizada');
    }

    public function destroy(Area $area)
    {
        Area::destroy($area->id);

        return redirect()->route('areas.index')->with('success', 'Area eliminada');
    }
}
