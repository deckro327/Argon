@extends('layouts.panel')
@section('title', 'Animal/Show')n

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Carrer</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('carrers.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                        <div class="form-group mb-2 mb20">
                            <strong>Name:</strong>
                            {{ $carrer->name }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Code:</strong>
                            {{ $carrer->code }}
                        </div>
                        <div class="form-group mb-2 mb20">
                            <strong>Students Id:</strong>
                            {{ $carrer->students_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
