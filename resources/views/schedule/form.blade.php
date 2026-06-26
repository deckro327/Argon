<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="date">Fecha</label>
            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', optional($schedule)->date?->format('Y-m-d')) }}">
            @error('date')
                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="time">Hora</label>
            <input type="time" name="time" id="time" class="form-control @error('time') is-invalid @enderror" value="{{ old('time', optional($schedule)->time ? \Illuminate\Support\Carbon::parse(optional($schedule)->time)->format('H:i') : '') }}">
            @error('time')
                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="col-12">
        @if ($schedule->exists)
            @method('PUT')
        @endif
        <button type="submit" class="btn btn-primary">{{ $schedule->exists ? 'Actualizar' : 'Guardar' }}</button>
        <a href="{{ route('schedules.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</div>
