@extends('layouts.panel')
@section('title', 'Attendance/Show')

@section('content')
    @php
        $attendancePunctuality = $attendance->punctuality ? \Illuminate\Support\Carbon::parse($attendance->punctuality) : null;
        $attendanceDeparture = $attendance->departure ? \Illuminate\Support\Carbon::parse($attendance->departure) : null;
        $areaPunctuality = $attendance->worker?->area?->punctuality ? \Illuminate\Support\Carbon::parse($attendance->worker?->area?->punctuality) : null;
        $areaDeparture = $attendance->worker?->area?->departure ? \Illuminate\Support\Carbon::parse($attendance->worker?->area?->departure) : null;
    @endphp

    <div class="col-xl-12 order-xl-1">
        <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0"><i class="fas fa-newspaper"></i> Ver asistencia</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('attendances.index') }}" class="btn btn-sm btn-primary"><i class="fas fa-list"></i> Volver</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h6 class="heading-small text-muted mb-4">Información de asistencia</h6>
                <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Worker</label>
                                <p>{{ $attendance->worker_id }} - {{ $attendance->worker?->name }} {{ $attendance->worker?->surname }}</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Area</label>
                                <p>{{ $attendance->worker?->area?->name ?? 'Sin área' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Horario del área - Entrada</label>
                                <p>{{ $areaPunctuality ? $areaPunctuality->format('h:i') : '-' }} {{ $areaPunctuality ? $areaPunctuality->format('A') : '' }}</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Horario del área - Salida</label>
                                <p>{{ $areaDeparture ? $areaDeparture->format('h:i') : '-' }} {{ $areaDeparture ? $areaDeparture->format('A') : '' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Status</label>
                                <p>{{ $attendance->status_label }}</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Fecha de registro</label>
                                <p>{{ $attendance->created_at }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Punctuality</label>
                                <p>{{ $attendancePunctuality ? $attendancePunctuality->format('h:i') : '-' }} {{ $attendancePunctuality ? $attendancePunctuality->format('A') : '' }}</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Departure</label>
                                <p>{{ $attendanceDeparture ? $attendanceDeparture->format('h:i') : '-' }} {{ $attendanceDeparture ? $attendanceDeparture->format('A') : '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
