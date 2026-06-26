@extends('layouts.panel')
@section('title', 'Horarios')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="card-title">Listado de horarios</span>
                        <a href="{{ route('schedules.create') }}" class="btn btn-primary btn-sm">Nuevo horario</a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success m-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($schedules as $schedule)
                                        <tr>
                                            <td>{{ $schedule->id }}</td>
                                            <td>{{ optional($schedule->date)->format('Y-m-d') }}</td>
                                            <td>{{ optional($schedule->time)->format('H:i') ?? $schedule->time }}</td>
                                            <td>
                                                <a href="{{ route('schedules.show', $schedule->id) }}" class="btn btn-sm btn-info">Ver</a>
                                                <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-sm btn-success">Editar</a>
                                                <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Eliminar este horario?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No hay horarios registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $schedules->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
