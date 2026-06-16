@extends('layouts.panel')
@section('title', 'Animal/Create')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} worker</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('workers.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">

                        <div class="form-group mb-2 mb20">
                            <strong>Name:</strong>
                            {{ $worker->name }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>ID:</strong>
                            {{ $worker->id }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Surname:</strong>
                            {{ $worker->surname }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Email:</strong>
                            {{ $worker->email }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Age:</strong>
                            {{ $worker->age }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Area:</strong>
                            {{ $worker->area?->name }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
