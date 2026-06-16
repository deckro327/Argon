<div class="mb-3 flex flex-col gap-4">
    <label for="name" class="form-label text-white">Nombre</label>
    <input name="name" id="name" class="form-label-control text-dark w-96" value="{{ old('name', $worker?->name) }}" type="text">
    @error('name')
        <div class="text-danger text-red-400">{{ $message }}</div>
    @enderror

    <label for="surname" class="form-label text-white">Apellido</label>
    <input name="surname" id="surname" class="form-label-control text-dark w-96" value="{{ old('surname', $worker?->surname) }}" type="text">
    @error('surname')
        <div class="text-danger text-red-400">{{ $message }}</div>
    @enderror

    <label for="email" class="form-label text-white">Correo</label>
    <input name="email" id="email" class="form-label-control text-dark w-96" value="{{ old('email', $worker?->email) }}" type="email">
    @error('email')
        <div class="text-danger text-red-400">{{ $message }}</div>
    @enderror

    <label for="age" class="form-label text-white">Edad</label>
    <input name="age" id="age" class="form-label-control text-dark w-96" value="{{ old('age', $worker?->age) }}" type="number">
    @error('age')
        <div class="text-danger text-red-400">{{ $message }}</div>
    @enderror

    <label for="area_id" class="form-label text-white">Area</label>
    <select name="area_id" id="area_id" class="form-control text-dark w-96">
        <option value="">Seleccionar area</option>
        @foreach($areas as $area)
            <option value="{{ $area->id }}" @selected(old('area_id', $worker?->area_id) == $area->id)>{{ $area->name }}</option>
        @endforeach
    </select>
    @error('area_id')
        <div class="text-danger text-red-400">{{ $message }}</div>
    @enderror

    <button type="submit" class="btn btn-primary text-white bg-red-600 transition duration-300 p-2 rounded-lg">Guardar</button>
</div>
