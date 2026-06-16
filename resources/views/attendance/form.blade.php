@php
    $parseAttendanceTime = function ($value) {
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

    $selectedWorkerId = old('worker_id', $attendance?->worker_id);
    $selectedStatus = old('status', $attendance?->status === 'asistencia_confirmada' ? 'presente' : $attendance?->status);
    $selectedWorkerDefaults = $selectedWorkerId ? ($workerAttendanceDefaults[$selectedWorkerId] ?? null) : null;

    $workerLookupValue = old('worker_search', $selectedWorkerId ?? '');
    $selectedWorkerLabel = $selectedWorkerDefaults['label'] ?? '';
    $areaNameValue = $selectedWorkerDefaults['area_name'] ?? '';
    $areaPunctualityValue = $selectedWorkerDefaults['area_entry_time'] ?? '';
    $areaDepartureValue = $selectedWorkerDefaults['area_exit_time'] ?? '';

    $attendancePunctualityTime = $parseAttendanceTime(old('punctuality', $attendance?->punctuality ? \Illuminate\Support\Carbon::parse($attendance?->punctuality)->format('H:i') : ''));
    $attendanceDepartureTime = $parseAttendanceTime(old('departure', $attendance?->departure ? \Illuminate\Support\Carbon::parse($attendance?->departure)->format('H:i') : ''));
@endphp

<div class="row padding-1 p-1">
    <div class="col-md-12">
        <div class="form-group mb-2 mb20">
            <label for="worker_search" class="form-label">Worker</label>
            <div class="d-flex gap-2 align-items-center">
                <input
                    type="text"
                    name="worker_search"
                    id="worker_search"
                    class="form-control"
                    value="{{ $workerLookupValue }}"
                    list="workers-list"
                    placeholder="Escribe el ID del worker"
                    autocomplete="off"
                    inputmode="numeric"
                >
                <button type="button" class="btn btn-outline-secondary" id="clear_worker_search">Limpiar</button>
            </div>
            <input type="hidden" name="worker_id" id="worker_id" value="{{ $selectedWorkerId }}">
            <datalist id="workers-list">
                @foreach ($workers as $worker)
                    <option value="{{ $worker->id }}" label="{{ $worker->id }} - {{ $worker->name }} {{ $worker->surname }}"></option>
                @endforeach
            </datalist>
            <small class="form-text text-muted">Busca por ID y selecciona el worker correcto.</small>
            {!! $errors->first('worker_id', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="form-group mb-2 mb20">
            <label for="worker_name" class="form-label">Worker seleccionado</label>
            <input type="text" id="worker_name" class="form-control" value="{{ $selectedWorkerLabel }}" readonly>
        </div>

        <div class="form-group mb-2 mb20">
            <label for="worker_area" class="form-label">Area</label>
            <input type="text" id="worker_area" class="form-control" value="{{ $areaNameValue }}" readonly>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-2 mb20">
                    <label for="worker_area_punctuality" class="form-label">Punctuality del area</label>
                    <input type="text" id="worker_area_punctuality" class="form-control" value="{{ $areaPunctualityValue }}" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2 mb20">
                    <label for="worker_area_departure" class="form-label">Departure del area</label>
                    <input type="text" id="worker_area_departure" class="form-control" value="{{ $areaDepartureValue }}" readonly>
                </div>
            </div>
        </div>

        <div class="form-group mb-2 mb20">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                <option value="">Selecciona un status</option>
                @foreach ($statuses as $value => $label)
                    <option value="{{ $value }}" @selected($selectedStatus === $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            {!! $errors->first('status', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-2 mb20">
                    <label class="form-label" for="punctuality_hour">Punctuality</label>
                    <input type="hidden" name="punctuality" id="punctuality" value="{{ old('punctuality', $attendance?->punctuality ? \Illuminate\Support\Carbon::parse($attendance?->punctuality)->format('H:i') : '') }}">
                    <div class="d-flex gap-2 flex-wrap">
                        <select id="punctuality_hour" class="form-control @error('punctuality') is-invalid @enderror" style="max-width: 110px;" @disabled($selectedStatus !== 'presente')>
                            @for ($hour = 1; $hour <= 12; $hour++)
                                <option value="{{ sprintf('%02d', $hour) }}" {{ $attendancePunctualityTime['hour'] === sprintf('%02d', $hour) ? 'selected' : '' }}>{{ sprintf('%02d', $hour) }}</option>
                            @endfor
                        </select>
                        <span class="align-self-center">:</span>
                        <select id="punctuality_minute" class="form-control" style="max-width: 110px;" @disabled($selectedStatus !== 'presente')>
                            @for ($minute = 0; $minute <= 59; $minute++)
                                <option value="{{ sprintf('%02d', $minute) }}" {{ $attendancePunctualityTime['minute'] === sprintf('%02d', $minute) ? 'selected' : '' }}>{{ sprintf('%02d', $minute) }}</option>
                            @endfor
                        </select>
                        <select id="punctuality_meridiem" class="form-control" style="max-width: 110px;" @disabled($selectedStatus !== 'presente')>
                            <option value="AM" {{ $attendancePunctualityTime['meridiem'] === 'AM' ? 'selected' : '' }}>AM</option>
                            <option value="PM" {{ $attendancePunctualityTime['meridiem'] === 'PM' ? 'selected' : '' }}>PM</option>
                        </select>
                    </div>
                    <small class="text-muted">Formato de captura: hora, minutos y AM/PM.</small>
                    {!! $errors->first('punctuality', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-2 mb20">
                    <label class="form-label" for="departure_hour">Departure</label>
                    <input type="hidden" name="departure" id="departure" value="{{ old('departure', $attendance?->departure ? \Illuminate\Support\Carbon::parse($attendance?->departure)->format('H:i') : '') }}">
                    <div class="d-flex gap-2 flex-wrap">
                        <select id="departure_hour" class="form-control @error('departure') is-invalid @enderror" style="max-width: 110px;" @disabled($selectedStatus !== 'presente')>
                            @for ($hour = 1; $hour <= 12; $hour++)
                                <option value="{{ sprintf('%02d', $hour) }}" {{ $attendanceDepartureTime['hour'] === sprintf('%02d', $hour) ? 'selected' : '' }}>{{ sprintf('%02d', $hour) }}</option>
                            @endfor
                        </select>
                        <span class="align-self-center">:</span>
                        <select id="departure_minute" class="form-control" style="max-width: 110px;" @disabled($selectedStatus !== 'presente')>
                            @for ($minute = 0; $minute <= 59; $minute++)
                                <option value="{{ sprintf('%02d', $minute) }}" {{ $attendanceDepartureTime['minute'] === sprintf('%02d', $minute) ? 'selected' : '' }}>{{ sprintf('%02d', $minute) }}</option>
                            @endfor
                        </select>
                        <select id="departure_meridiem" class="form-control" style="max-width: 110px;" @disabled($selectedStatus !== 'presente')>
                            <option value="AM" {{ $attendanceDepartureTime['meridiem'] === 'AM' ? 'selected' : '' }}>AM</option>
                            <option value="PM" {{ $attendanceDepartureTime['meridiem'] === 'PM' ? 'selected' : '' }}>PM</option>
                        </select>
                    </div>
                    <small class="text-muted">Formato de captura: hora, minutos y AM/PM.</small>
                    {!! $errors->first('departure', '<div class="invalid-feedback d-block" role="alert"><strong>:message</strong></div>') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const workerDefaults = @json($workerAttendanceDefaults ?? []);
    const workerLookup = document.getElementById('worker_search');
    const workerIdField = document.getElementById('worker_id');
    const workerNameField = document.getElementById('worker_name');
    const workerAreaField = document.getElementById('worker_area');
    const areaPunctualityField = document.getElementById('worker_area_punctuality');
    const areaDepartureField = document.getElementById('worker_area_departure');
    const punctualityField = document.getElementById('punctuality');
    const departureField = document.getElementById('departure');
    const punctualityHourField = document.getElementById('punctuality_hour');
    const punctualityMinuteField = document.getElementById('punctuality_minute');
    const punctualityMeridiemField = document.getElementById('punctuality_meridiem');
    const departureHourField = document.getElementById('departure_hour');
    const departureMinuteField = document.getElementById('departure_minute');
    const departureMeridiemField = document.getElementById('departure_meridiem');
    const statusField = document.getElementById('status');

    const getWorkerById = (id) => {
        const worker = workerDefaults[id];

        if (!worker) {
            return null;
        }

        return { id, ...worker };
    };

    const getExactWorkerByLookupValue = (value) => {
        const rawValue = (value || '').trim();

        if (!rawValue) {
            return null;
        }

        const exactMatch = Object.entries(workerDefaults).find(([, worker]) => worker.label === rawValue || String(worker.id) === rawValue);

        if (!exactMatch) {
            return null;
        }

        return { id: exactMatch[0], ...exactMatch[1] };
    };

    const getWorkerBySearchValue = (value) => {
        const rawValue = (value || '').trim();

        if (!rawValue) {
            return null;
        }

        const exactMatch = getExactWorkerByLookupValue(rawValue);

        if (exactMatch) {
            return exactMatch;
        }

        if (/^\d+$/.test(rawValue)) {
            const prefixMatch = Object.entries(workerDefaults).find(([workerId]) => String(workerId).startsWith(rawValue));

            if (prefixMatch) {
                return { id: prefixMatch[0], ...prefixMatch[1] };
            }
        }

        return null;
    };

    const syncWorkerSelection = (worker) => {
        if (worker) {
            applyWorker(worker);
            return;
        }

        clearWorkerSelection();
    };

    const clearWorkerSelection = () => {
        workerIdField.value = '';
        workerNameField.value = '';
        workerAreaField.value = '';
        areaPunctualityField.value = '';
        areaDepartureField.value = '';
    };

    const applyWorker = (worker) => {
        if (!worker) {
            clearWorkerSelection();
            return;
        }

        workerIdField.value = worker.id;
        workerLookup.value = String(worker.id);
        workerNameField.value = worker.label || '';
        workerAreaField.value = worker.area_name || '';
        areaPunctualityField.value = worker.area_entry_time || '00:00';
        areaDepartureField.value = worker.area_exit_time || '00:00';
    };

    const timeToDisplay = (value) => {
        if (!value) {
            return {
                hour: '12',
                minute: '00',
                meridiem: 'AM',
            };
        }

        const [hourPart, minutePart] = value.split(':');
        let hour = parseInt(hourPart, 10);
        const minute = minutePart || '00';
        const meridiem = hour >= 12 ? 'PM' : 'AM';

        if (hour === 0) {
            hour = 12;
        } else if (hour > 12) {
            hour -= 12;
        }

        return {
            hour: String(hour).padStart(2, '0'),
            minute: String(minute).padStart(2, '0'),
            meridiem,
        };
    };

    const displayToTime = (hour, minute, meridiem) => {
        let numericHour = parseInt(hour, 10);

        if (meridiem === 'AM') {
            numericHour = numericHour === 12 ? 0 : numericHour;
        } else {
            numericHour = numericHour === 12 ? 12 : numericHour + 12;
        }

        return String(numericHour).padStart(2, '0') + ':' + String(minute).padStart(2, '0');
    };

    const syncHiddenTime = (hiddenField, hourField, minuteField, meridiemField) => {
        hiddenField.value = displayToTime(hourField.value, minuteField.value, meridiemField.value);
    };

    const setTimeFields = (hiddenField, hourField, minuteField, meridiemField, value) => {
        if (value === null || value === '') {
            hiddenField.value = '';
            hourField.disabled = true;
            minuteField.disabled = true;
            meridiemField.disabled = true;
            return;
        }

        const parsed = timeToDisplay(value);

        hiddenField.value = value;
        hourField.value = parsed.hour;
        minuteField.value = parsed.minute;
        meridiemField.value = parsed.meridiem;

        hourField.disabled = true;
        minuteField.disabled = true;
        meridiemField.disabled = true;
    };

    const releaseAutoTime = (hiddenField, hourField, minuteField, meridiemField) => {
        hiddenField.value = displayToTime(hourField.value, minuteField.value, meridiemField.value);
        hourField.disabled = false;
        minuteField.disabled = false;
        meridiemField.disabled = false;
    };

    const syncAttendanceTimes = () => {
        const worker = workerLookup.value ? getWorkerBySearchValue(workerLookup.value) || getWorkerById(workerIdField.value) : null;

        if (statusField.value === 'justificado') {
            setTimeFields(punctualityField, punctualityHourField, punctualityMinuteField, punctualityMeridiemField, worker?.area_entry_time || '00:00');
            setTimeFields(departureField, departureHourField, departureMinuteField, departureMeridiemField, worker?.area_exit_time || '00:00');
            return;
        }

        if (statusField.value === 'ausente') {
            setTimeFields(punctualityField, punctualityHourField, punctualityMinuteField, punctualityMeridiemField, null);
            setTimeFields(departureField, departureHourField, departureMinuteField, departureMeridiemField, null);
            return;
        }

        releaseAutoTime(punctualityField, punctualityHourField, punctualityMinuteField, punctualityMeridiemField);
        releaseAutoTime(departureField, departureHourField, departureMinuteField, departureMeridiemField);
    };

    punctualityHourField.addEventListener('change', function () {
        syncHiddenTime(punctualityField, punctualityHourField, punctualityMinuteField, punctualityMeridiemField);
    });

    punctualityMinuteField.addEventListener('change', function () {
        syncHiddenTime(punctualityField, punctualityHourField, punctualityMinuteField, punctualityMeridiemField);
    });

    punctualityMeridiemField.addEventListener('change', function () {
        syncHiddenTime(punctualityField, punctualityHourField, punctualityMinuteField, punctualityMeridiemField);
    });

    departureHourField.addEventListener('change', function () {
        syncHiddenTime(departureField, departureHourField, departureMinuteField, departureMeridiemField);
    });

    departureMinuteField.addEventListener('change', function () {
        syncHiddenTime(departureField, departureHourField, departureMinuteField, departureMeridiemField);
    });

    departureMeridiemField.addEventListener('change', function () {
        syncHiddenTime(departureField, departureHourField, departureMinuteField, departureMeridiemField);
    });

    document.getElementById('clear_worker_search').addEventListener('click', function () {
        workerLookup.value = '';
        clearWorkerSelection();
        syncAttendanceTimes();
        workerLookup.focus();
    });

    workerLookup.addEventListener('input', function () {
        if (!this.value.trim()) {
            clearWorkerSelection();
            syncAttendanceTimes();
            return;
        }

        clearWorkerSelection();
        syncAttendanceTimes();
    });

    workerLookup.addEventListener('change', function () {
        const worker = getWorkerBySearchValue(this.value);

        syncWorkerSelection(worker);

        syncAttendanceTimes();
    });

    statusField.addEventListener('change', syncAttendanceTimes);

    if (workerLookup.value) {
        const worker = getWorkerBySearchValue(workerLookup.value);

        if (worker) {
            applyWorker(worker);
        }
    }

    syncAttendanceTimes();
});
</script>
