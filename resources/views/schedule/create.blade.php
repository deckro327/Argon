@extends('layouts.panel')
@section('title', 'Crear Horario')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear nuevo horario</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('schedules.store') }}">
                            @csrf
                            @include('schedule.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
