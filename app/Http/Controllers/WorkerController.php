<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use App\Models\Area;
use App\Http\Requests\WorkerRequest;
use Illuminate\Http\Request;

/**
 * Class WorkersController
 * @package App\Http\Controllers
 */
class WorkerController extends Controller
{
public function index(Request $request)
{
    $workers = Worker::with('area')->get();
    $i = 0;

    return view('worker.index', compact('workers', 'i'));
}

    public function create()
    {
        $worker = new Worker();
        $areas = Area::all()->sortBy('name');

        return view('worker.create', compact('worker', 'areas'));
    }

    public function store(WorkerRequest $request)
    {
        Worker::create($request->validated());

        return redirect()->route('workers.index')->with('success', 'Trabajador confirmado');
    }

    public function show (Worker $worker)
    {
        $worker->load('area');

        return view('worker.show', compact('worker'));
    }
    public function edit (Worker $worker)
    {
        $areas = Area::all()->sortBy('name');

        return view('worker.edit', compact('worker', 'areas'));
    }

    public function update(WorkerRequest $request, Worker $worker)
    {
        $worker->update($request->validated());

        return redirect()->route('workers.index')->with('success', 'la informacion del trabajador se ah acutalizado');
    }

    public function destroy(Worker $worker)
    {
        Worker::destroy($worker->id);

        return redirect()->route('workers.index')->with('success', 'Trabajador eliminado');
    }
}

