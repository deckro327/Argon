@extends('layouts.panel')
@section('title', 'Animal/Create')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Carrer</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST" action="{{ route('carrers.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('carrer.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
