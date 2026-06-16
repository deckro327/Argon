@extends('layouts.app')

@section('content')
    <div class="card flex flex-col justify-center items-center">
        <form action="{{ route('workers.update', $worker->id) }}" method="POST" class="ml-40 mt-10">
            @method('PUT')
            <h1 class="text-white">Editar Worker</h1>
            @csrf

            @include('worker.form')
        </form>
    </div>
@endsection
