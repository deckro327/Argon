<?php

namespace App\Http\Controllers;

use App\Models\Carrer;
use App\Models\Worker;
use App\Models\Student;
use App\Http\Requests\CarrerRequest;

/**
 * Class CarrerController
 * @package App\Http\Controllers
 */
class CarrerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carrers = Carrer::query()->paginate();

        return view('carrer.index', compact('carrers'))
            ->with('i', (request()->input('page', 1) - 1) * $carrers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carrer = new Carrer();
        $students = Worker::all()->sortBy('name');
        return view('carrer.create', compact('carrer', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarrerRequest $request)
    {
        Carrer::create($request->validated());

        return redirect()->route('carrers.index')
            ->with('success', 'Carrer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $carrer = Carrer::query()->find($id);

        return view('carrer.show', compact('carrer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $carrer = Carrer::query()->find($id);

        $students = Worker::all()->sortBy('name');
        return view('carrer.edit', compact('carrer', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarrerRequest $request, Carrer $carrer)
    {
        $carrer->update($request->validated());

        return redirect()->route('carrers.index')
            ->with('success', 'Carrer updated successfully');
    }

    public function destroy($id)
    {
        Carrer::destroy($id);

        return redirect()->route('carrers.index')
            ->with('success', 'Carrer deleted successfully');
    }
}
