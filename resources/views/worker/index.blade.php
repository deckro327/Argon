@extends('layouts.panel')
@section('title', 'Worker/Index')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="mb-0">Workers</h3>
                            <a href="{{ route('workers.create') }}" class="btn btn-primary btn-sm">Crear Worker</a>
                        </div>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success m-4">
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Edad</th>
                                    <th scope="col">Area</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($workers as $worker)
                                    <tr>
                                        <td>{{ $worker->id }}</td>
                                        <td>{{ $worker->name }}</td>
                                        <td>{{ $worker->surname }}</td>
                                        <td>{{ $worker->email }}</td>
                                        <td>{{ $worker->age }}</td>
                                        <td>{{ $worker->area?->name }}</td>
                                        <td style="white-space: nowrap;">
                                            <div style="display: flex; align-items: center; gap: 5px; flex-wrap: nowrap;">
                                                <a class="btn btn-primary btn-sm" href="{{ route('workers.show', $worker->id) }}">Ver</a>
                                                <a class="btn btn-info btn-sm" href="{{ route('workers.edit', $worker->id) }}">Editar</a>
                                                <form action="{{ route('workers.destroy', $worker->id) }}" method="POST" style="display: inline-block; margin: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este worker?')">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
