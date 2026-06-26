@extends('layouts.panel')
@section('title', 'Ver Horario')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="card-title">Detalle del horario</span>
                        <a href="{{ route('schedules.index') }}" class="btn btn-secondary btn-sm">Volver</a>
                    </div>
                    <div class="card-body bg-white">
                        <div class="mb-3">
                            <strong>ID:</strong> {{ $schedule->id }}
                        </div>
                        <div class="mb-3">
                            <strong>Fecha:</strong> {{ optional($schedule->date)->format('Y-m-d') }}
                        </div>
                        <div class="mb-3">
                            <strong>Hora:</strong> {{ optional($schedule->time)->format('H:i') ?? $schedule->time }}
                        </div>
                        <div>
                            <a href="{{ route('schedules.edit', $schedule->id) }}" class="btn btn-primary">Editar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
