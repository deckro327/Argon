<h6 class="heading-small text-muted mb-4">Datos del Area</h6>
<div class="pl-lg-4">
    @php
        $parseAreaTime = function ($value) {
            if (!$value) {
                return ['hour' => '', 'minute' => '', 'meridiem' => 'AM'];
            }

            $time = \Illuminate\Support\Carbon::parse($value);

            return [
                'hour' => $time->format('h'),
                'minute' => $time->format('i'),
                'meridiem' => $time->format('A'),
            ];
        };

        $punctualityTime = $parseAreaTime(old('punctuality', $area?->punctuality));
        $departureTime = $parseAreaTime(old('departure', $area?->departure));
    @endphp

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label" for="name">Nombre</label>
                <input type="text" id="name" name="name" class="form-control form-control-alternative @error('name') is-invalid @enderror"
                    placeholder="Agregar un nombre" value="{{ old('name', $area?->name) }}">
                {!! $errors->first('name', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label" for="punctuality">Punctuality</label>
                <input type="hidden" id="punctuality" name="punctuality" value="{{ old('punctuality', $area?->punctuality ? \Illuminate\Support\Carbon::parse($area?->punctuality)->format('H:i') : '') }}">
                <div class="d-flex gap-2 flex-wrap">
                    <select id="punctuality_hour" class="form-control form-control-alternative @error('punctuality') is-invalid @enderror" style="max-width: 110px;">
                        @for ($hour = 1; $hour <= 12; $hour++)
                            <option value="{{ sprintf('%02d', $hour) }}" {{ $punctualityTime['hour'] === sprintf('%02d', $hour) ? 'selected' : '' }}>{{ sprintf('%02d', $hour) }}</option>
                        @endfor
                    </select>
                    <span class="align-self-center">:</span>
                    <select id="punctuality_minute" class="form-control form-control-alternative" style="max-width: 110px;">
                        @for ($minute = 0; $minute <= 59; $minute++)
                            <option value="{{ sprintf('%02d', $minute) }}" {{ $punctualityTime['minute'] === sprintf('%02d', $minute) ? 'selected' : '' }}>{{ sprintf('%02d', $minute) }}</option>
                        @endfor
                    </select>
                    <select id="punctuality_meridiem" class="form-control form-control-alternative" style="max-width: 110px;">
                        <option value="AM" {{ $punctualityTime['meridiem'] === 'AM' ? 'selected' : '' }}>AM</option>
                        <option value="PM" {{ $punctualityTime['meridiem'] === 'PM' ? 'selected' : '' }}>PM</option>
                    </select>
                </div>
                <small class="text-muted">Formato de captura: hora, minutos y AM/PM.</small>
                {!! $errors->first('punctuality', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label class="form-control-label" for="departure">Departure</label>
                <input type="hidden" id="departure" name="departure" value="{{ old('departure', $area?->departure ? \Illuminate\Support\Carbon::parse($area?->departure)->format('H:i') : '') }}">
                <div class="d-flex gap-2 flex-wrap">
                    <select id="departure_hour" class="form-control form-control-alternative @error('departure') is-invalid @enderror" style="max-width: 110px;">
                        @for ($hour = 1; $hour <= 12; $hour++)
                            <option value="{{ sprintf('%02d', $hour) }}" {{ $departureTime['hour'] === sprintf('%02d', $hour) ? 'selected' : '' }}>{{ sprintf('%02d', $hour) }}</option>
                        @endfor
                    </select>
                    <span class="align-self-center">:</span>
                    <select id="departure_minute" class="form-control form-control-alternative" style="max-width: 110px;">
                        @for ($minute = 0; $minute <= 59; $minute++)
                            <option value="{{ sprintf('%02d', $minute) }}" {{ $departureTime['minute'] === sprintf('%02d', $minute) ? 'selected' : '' }}>{{ sprintf('%02d', $minute) }}</option>
                        @endfor
                    </select>
                    <select id="departure_meridiem" class="form-control form-control-alternative" style="max-width: 110px;">
                        <option value="AM" {{ $departureTime['meridiem'] === 'AM' ? 'selected' : '' }}>AM</option>
                        <option value="PM" {{ $departureTime['meridiem'] === 'PM' ? 'selected' : '' }}>PM</option>
                    </select>
                </div>
                <small class="text-muted">Formato de captura: hora, minutos y AM/PM.</small>
                {!! $errors->first('departure', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label" for="description">Descripción</label>
                <textarea id="description" name="description" class="form-control form-control-alternative @error('description') is-invalid @enderror" rows="4" placeholder="Agregar una descripción">{{ old('description', $area?->description) }}</textarea>
                {!! $errors->first('description', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
            </div>
        </div>
    </div>
</div>

<hr class="my-4" />
<h6 class="heading-small text-muted mb-4">Guardar</h6>
<div class="pl-lg-4">
    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Registrar
        </button>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function syncToTwentyFourHour(hour, minute, meridiem) {
            let numericHour = parseInt(hour, 10);

            if (meridiem === 'AM') {
                numericHour = numericHour === 12 ? 0 : numericHour;
            } else {
                numericHour = numericHour === 12 ? 12 : numericHour + 12;
            }

            return String(numericHour).padStart(2, '0') + ':' + minute;
        }

        function bindTimePicker(prefix) {
            const hiddenInput = document.getElementById(prefix);
            const hourSelect = document.getElementById(prefix + '_hour');
            const minuteSelect = document.getElementById(prefix + '_minute');
            const meridiemSelect = document.getElementById(prefix + '_meridiem');

            function updateHiddenValue() {
                hiddenInput.value = syncToTwentyFourHour(
                    hourSelect.value,
                    minuteSelect.value,
                    meridiemSelect.value
                );
            }

            hourSelect.addEventListener('change', updateHiddenValue);
            minuteSelect.addEventListener('change', updateHiddenValue);
            meridiemSelect.addEventListener('change', updateHiddenValue);
            updateHiddenValue();
        }

        bindTimePicker('punctuality');
        bindTimePicker('departure');
    });
</script>