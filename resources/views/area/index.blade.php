@extends('layouts.panel')
@section('title', 'Area')

@section('content')
	<div class="col-xl-12 order-xl-1">
		<div class="card bg-secondary shadow">
			<div class="card-header bg-white border-0">
				<div class="row align-items-center">
					<div class="col-8">
						<h3 class="mb-0"><i class="fas fa-building text-blue"></i> Areas</h3>
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
								<th scope="col"> ID</th>
								<th scope="col"> Nombre</th>
								<th scope="col"> Descripción</th>
								<th scope="col"> Fecha de Registro</th>
								<th scope="col"> Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($areas as $area)
								<tr>
								<td>{{ $area->id }}</td>
									<td>{{ $area->name }}</td>
									<td>{{ $area->description }}</td>
									<td>{{ $area->created_at }}</td>
									<td style="white-space: nowrap; display: flex; align-items: center;">
										<a href="{{ route('areas.show', $area) }}" class="btn btn-primary btn-sm" style="margin-right: 5px;">Mostrar</a>
										<a href="{{ route('areas.edit', $area) }}" class="btn btn-info btn-sm" style="margin-right: 5px;">Editar</a>
										<a href="{{ route('areas.delete', $area->id) }}" class="btn btn-danger btn-sm">Eliminar</a>
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
