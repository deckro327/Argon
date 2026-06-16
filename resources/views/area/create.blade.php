@extends('layouts.panel')
@section('title', 'Area/Create')

@section('content')
	<div class="col-xl-12 order-xl-1">
		<div class="card bg-secondary shadow">
			<div class="card-header bg-white border-0">
				<div class="row align-items-center">
					<div class="col-8">
						<h3 class="mb-0"> Crear Area</h3>
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('areas.index') }}" class="btn btn-sm btn-primary"><i class="fas fa-arrow-left"></i> Volver</a>
					</div>
				</div>
			</div>
			<div class="card-body container-fluid">
				<form action="{{ route('areas.store') }}" method="POST">
					@csrf
					@include('area.form')
				</form>
			</div>
		</div>
	</div>
@endsection
