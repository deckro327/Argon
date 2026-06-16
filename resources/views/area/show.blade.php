@extends('layouts.panel')
@section('title', 'Area/Show')

@section('content')
	<div class="col-xl-12 order-xl-1">
		<div class="card bg-secondary shadow">
			<div class="card-header bg-white border-0">
				<div class="row align-items-center">
					<div class="col-8">
						<h3 class="mb-0" ><i class="fas fa-newspaper"></i> Ver Area</h3>
					</div>
					<div class="col-4 text-right">
						<a href="{{ route('areas.index') }}" class="btn btn-sm btn-primary"><i class="fas fa-list"></i> Volver</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<h6 class="heading-small text-muted mb-4">Información del Area</h6>
				<div class="pl-lg-4">
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="form-control-label"><i class="fas fa-heading"></i> Nombre</label>
								<p>{{ $area->name }}</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="form-control-label"><i class="fas fa-align-left"></i> Descripción</label>
								<p>{{ $area->description }}</p>
							</div>
						</div>
					</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label class="form-control-label"><i class="fas fa-clock"></i> Punctuality</label>
								<p>{{ $area->punctuality ? \Illuminate\Support\Carbon::parse($area->punctuality)->format('h:i A') : '-' }}</p>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label class="form-control-label"><i class="fas fa-sign-out-alt"></i> Departure</label>
								<p>{{ $area->departure ? \Illuminate\Support\Carbon::parse($area->departure)->format('h:i A') : '-' }}</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="form-group">
								<label class="form-control-label"><i class="fas fa-users"></i> Trabajadores</label>
								<table class="table table-sm table-striped mt-2">
									<thead>
										<tr>
											<th>ID</th>
											<th>Nombre</th>
											<th>Correo</th>
										</tr>
									</thead>
									<tbody>
										@forelse ($area->workers as $worker)
											<tr>
												<td>{{ $worker->id }}</td>
												<td>{{ $worker->name }} {{ $worker->surname }}</td>
												<td>{{ $worker->email }}</td>
											</tr>
										@empty
											<tr>
												<td colspan="3" class="text-center text-muted">No hay trabajadores registrados en esta area.</td>
											</tr>
										@endforelse
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label class="form-control-label"><i class="fas fa-calendar-check"></i> Fecha de Registro</label>
								<p>{{ $area->created_at }}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
