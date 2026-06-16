@extends('layouts.app')

@section('content')
    <div class="card flex flex-col justify-center items-center">
        <form action="{{ route('workers.store') }}" method="POST" class="ml-40 mt-10">
            <h1 class="text-white">Crear Worker</h1>
            @csrf

            @include('worker.form')
        </form>
    </div>
@endsection
