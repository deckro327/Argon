@extends('layouts.panel')
@section('title', 'Area/Delete')

@section('content')
	<div class="col-xl-12 order-xl-1">
		<div class="card bg-secondary shadow">
			<div class="card-header bg-white border-0">
				<div class="row align-items-center">
					<div class="col-8">
						<h3 class="mb-0">Eliminar Area</h3>
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('areas.index') }}" class="btn btn-sm btn-secondary">Cancelar</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<p>¿Deseas eliminar el área <strong>{{ $area->name }}</strong> (ID: {{ $area->id }})?</p>

				<form action="{{ route('areas.destroy', $area->id) }}" method="POST" onsubmit="return confirm('Confirmar eliminación');">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-danger">Eliminar Area</button>
					<a href="{{ route('areas.index') }}" class="btn btn-secondary">Cancelar</a>
				</form>
			</div>
		</div>
	</div>
@endsection
