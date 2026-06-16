@extends('layouts.panel')
@section('title', 'Worker/Delete')

@section('content')
    <div class="col-xl-12 order-xl-1">
        <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">Eliminar Trabajador</h3>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('workers.index') }}" class="btn btn-sm btn-secondary">Cancelar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p>¿Deseas eliminar al trabajador <strong>{{ $worker->name }} {{ $worker->surname }}</strong> (ID: {{ $worker->id }})?</p>

                <form action="{{ route('workers.destroy', $worker->id) }}" method="POST" onsubmit="return confirm('Confirmar eliminación');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar Trabajador</button>
                    <a href="{{ route('workers.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
