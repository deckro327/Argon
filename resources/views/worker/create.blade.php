@extends('layouts.panel')
@section('title', 'Worker/Create')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Trabajador</span>
                        <div class="card-tools float-right">
                            <a href="{{ route('workers.index') }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Volver</a>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <form action="{{ route('workers.store') }}" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <input name="name" id="name" class="form-control" value="{{ old('name') }}" type="text" placeholder="Nombre">
                                    {!! $errors->first('name', '<div class="invalid-feedback d-block">:message</div>') !!}
                                </div>
                                <div class="col-md-3">
                                    <input name="surname" id="surname" class="form-control" value="{{ old('surname') }}" type="text" placeholder="Apellido">
                                    {!! $errors->first('surname', '<div class="invalid-feedback d-block">:message</div>') !!}
                                </div>
                                <div class="col-md-4">
                                    <input name="email" id="email" class="form-control" value="{{ old('email') }}" type="email" placeholder="Correo">
                                    {!! $errors->first('email', '<div class="invalid-feedback d-block">:message</div>') !!}
                                </div>
                                <div class="col-md-2">
                                    <input name="age" id="age" class="form-control" value="{{ old('age') }}" type="number" min="0" step="1" placeholder="Edad" oninput="if(this.value<0){this.value='0'}">
                                    {!! $errors->first('age', '<div class="invalid-feedback d-block">:message</div>') !!}
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <select name="area_id" id="area_id" class="form-control">
                                        <option value="">Seleccionar area</option>
                                        @foreach($areas as $area)
                                            <option value="{{ $area->id }}" @selected(old('area_id') == $area->id)>{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('area_id', '<div class="invalid-feedback d-block">:message</div>') !!}
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
