@extends('layouts.panel')
@section('title', 'Area')

@section('content')
	<div class="col-xl-12 order-xl-1">
		<div class="card bg-secondary shadow">
			<div class="card-header bg-white border-0">
				<div class="row align-items-center">
					<div class="col-8">
						<h3 class="mb-0"><i class="fas fa-map-marker-alt"></i> Areas</h3>
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('areas.create') }}" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Nueva Area</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				@if ($message = Session::get('success'))
					<div class="alert alert-success">
						<p>{{ $message }}</p>
					</div>
				@endif


				<div class="table-responsive">
					<table class="table align-items-center table-flush">
						<thead class="thead-light">
							<tr>
								<th scope="col"><i class="fas fa-list-ol"></i> ID</th>
								<th scope="col"><i class="fas fa-heading"></i> Nombre</th>
								<th scope="col"><i class="fas fa-align-left"></i> Descripción</th>
								<th scope="col"><i class="fas fa-calendar-check"></i> Fecha de Registro</th>
								<th scope="col"><i class="fas fa-cogs"></i> Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($areas as $area)
								<tr>
								<td><span class="badge badge-pill badge-primary">{{ $area->id }}</span></td>
									<td>{{ $area->name }}</td>
									<td>{{ $area->description }}</td>
									<td>{{ $area->created_at }}</td>
									<td style="white-space: nowrap; display: flex; align-items: center;">
										<a href="{{ route('areas.show', $area) }}" class="btn btn-primary btn-sm" style="margin-right: 5px;">Mostrar</a>
										<a href="{{ route('areas.edit', $area) }}" class="btn btn-info btn-sm" style="margin-right: 5px;">Editar</a>
										<form action="{{ route('areas.destroy', $area->id) }}" method="POST" style="display: inline-block; margin: 0; display: flex; align-items: center;">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
										</form>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer py-4">
				<nav aria-label="..." class="d-flex flex-wrap justify-content-center justify-content-lg-start">
					{{ $areas->links() }}
				</nav>
			</div>
		</div>
	</div>
@endsection
