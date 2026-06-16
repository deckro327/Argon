@extends('layouts.panel')
@section('title', 'Attendance/Index')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">Historial de asistencia</span>
                            <div class="float-right">
                                <a href="{{ route('attendances.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                    Crear nueva asistencia
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>ID</th>
                                        <th>Trabajador</th>
                                        <th>Area</th>
                                        <th>Horario del área</th>
                                        <th>Estado</th>
                                        <th>Hora de entrada</th>
                                        <th>Hora de salida</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $attendance)
                                        <tr>
                                            <td>{{ $attendance->id }}</td>
                                            <td>{{ $attendance->worker_id }} - {{ $attendance->worker?->name }} {{ $attendance->worker?->surname }}</td>
                                            <td>{{ $attendance->worker?->area?->name ?? 'Sin área' }}</td>
                                            <td>
                                                <div>Entrada: {{ $attendance->worker?->area?->punctuality ? \Illuminate\Support\Carbon::parse($attendance->worker?->area?->punctuality)->format('h:i A') : '-' }}</div>
                                                <div>Salida: {{ $attendance->worker?->area?->departure ? \Illuminate\Support\Carbon::parse($attendance->worker?->area?->departure)->format('h:i A') : '-' }}</div>
                                            </td>
                                            <td>{{ $attendance->status_label }}</td>
                                            <td>{{ $attendance->punctuality }}</td>
                                            <td>{{ $attendance->departure }}</td>
                                            <td>
                                                <a class="btn btn-sm btn-primary" href="{{ route('attendances.show', $attendance->id) }}">
                                                    <i class="fa fa-fw fa-eye"></i> Ver
                                                </a>
                                                <a class="btn btn-sm btn-success" href="{{ route('attendances.edit', $attendance->id) }}">
                                                    <i class="fa fa-fw fa-edit"></i> Editar
                                                </a>
                                                <a class="btn btn-sm btn-danger" href="{{ route('attendances.delete', $attendance->id) }}">
                                                    <i class="fa fa-fw fa-trash"></i> Borrar
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $attendances->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
