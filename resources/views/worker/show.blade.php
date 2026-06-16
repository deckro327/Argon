@extends('layouts.panel')
@section('title', 'Worker/Show')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header border-0 d-flex justify-content-between align-items-center">
                        <span class="card-title mb-0">Ver Worker</span>
                        <a class="btn btn-primary btn-sm" href="{{ route('workers.index') }}">Volver</a>
                    </div>

                    <div class="card-body bg-white">
                        <div class="form-group mb-3">
                            <strong>ID:</strong> {{ $worker->id }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Nombre:</strong> {{ $worker->name }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Apellido:</strong> {{ $worker->surname }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Correo:</strong> {{ $worker->email }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Edad:</strong> {{ $worker->age }}
                        </div>
                        <div class="form-group mb-3">
                            <strong>Area:</strong> {{ $worker->area?->name ?? 'Sin area' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
