@extends('layouts.panel')
@section('title', 'Worker/Index')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                Workers
                            </span>

                            <div class="float-right">
                                <a href="{{ route('workers.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                    Create New
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
                                        <th>Name</th>
                                        <th>Surname</th>
                                        <th>Email</th>
                                        <th>Age</th>
                                        <th>Area</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($workers as $worker)
                                        <tr>
                                            <td>{{ $worker->id }}</td>
                                            <td>{{ $worker->name }}</td>
                                            <td>{{ $worker->surname }}</td>
                                            <td>{{ $worker->email }}</td>
                                            <td>{{ $worker->age }}</td>
                                            <td>{{ $worker->area?->name }}</td>

                                            <td>
                                                <form action="{{ route('workers.destroy', $worker->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary" href="{{ route('workers.show', $worker->id) }}">
                                                        <i class="fa fa-fw fa-eye"></i> Show
                                                    </a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('workers.edit', $worker->id) }}">
                                                        <i class="fa fa-fw fa-edit"></i> Edit
                                                    </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-fw fa-trash"></i> Delete
                                                    </button>
                                                </form>
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
    </div>
@endsection
