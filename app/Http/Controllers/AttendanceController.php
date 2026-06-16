<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Models\Worker;
use Illuminate\Support\Carbon;

class AttendanceController extends Controller
{
    private const STATUSES = [
        'presente' => 'Presente',
        'justificado' => 'Justificado',
        'ausente' => 'Ausente',
    ];

    public function index(Request $request)
    {
        $attendances = Attendance::with('worker.area')->latest()->paginate(10);

        return view('attendance.index', compact('attendances'))
            ->with('i', (request()->input('page', 1) - 1) * $attendances->perPage());
    }

    public function create(Request $request)
    {
        return view('attendance.create', $this->attendanceFormData(new Attendance()));
    }

    public function store(AttendanceRequest $request)
    {
        $data = $this->applyAttendanceTimeRules($request->validated());

        Attendance::create($data);

        return redirect()->route('attendances.index')->with('success', 'asistencia confirmada');
    }

    public function show (Attendance $attendance)
    {
        $attendance->load('worker.area');

        return view('attendance.show', compact('attendance'));
    }

    public function edit(Attendance $attendance)
    {
        return view('attendance.edit', $this->attendanceFormData($attendance));
    }

    public function update(AttendanceRequest $request, Attendance $attendance)
    {
        $data = $this->applyAttendanceTimeRules($request->validated());

        $attendance->update($data);

        return redirect()->route('attendances.index')->with('success', 'asistencia actualizada');
    }

    public function destroy(Attendance $attendance)
    {
        Attendance::destroy($attendance->id);

        return redirect()->route('attendances.index')->with('success','asistencia eliminada');
    }

    private function buildWorkerAttendanceDefaults($workers): array
    {
        return $workers->mapWithKeys(function ($worker) {
            $area = $worker->area;

            return [
                $worker->id => [
                    'label' => $worker->id.' - '.$worker->name.' '.$worker->surname,
                    'area_name' => $area?->name,
                    'area_entry_time' => $area?->punctuality ? Carbon::parse($area->punctuality)->format('H:i') : null,
                    'area_exit_time' => $area?->departure ? Carbon::parse($area->departure)->format('H:i') : null,
                ],
            ];
        })->toArray();
    }

    private function attendanceFormData(Attendance $attendance): array
    {
        $workers = Worker::with('area')->get()->sortBy('id');

        return [
            'attendance' => $attendance,
            'workers' => $workers,
            'statuses' => self::STATUSES,
            'workerAttendanceDefaults' => $this->buildWorkerAttendanceDefaults($workers),
            'showAttendanceTimes' => true,
        ];
    }

    private function applyAttendanceTimeRules(array $data): array
    {
        $worker = Worker::with('area')->find($data['worker_id'] ?? null);
        $status = $data['status'] ?? null;

        if ($status === 'justificado') {
            $data['punctuality'] = $this->timeToDateTime($worker?->area?->punctuality);
            $data['departure'] = $this->timeToDateTime($worker?->area?->departure);

            return $data;
        }

        if ($status === 'ausente') {
            $data['punctuality'] = $this->timeToDateTime('00:00');
            $data['departure'] = $this->timeToDateTime('00:00');

            return $data;
        }

        if ($status === 'presente') {
            $data['punctuality'] = $this->timeToDateTime($data['punctuality'] ?? null);
            $data['departure'] = $this->timeToDateTime($data['departure'] ?? null);

            return $data;
        }

        return $data;
    }

    private function timeToDateTime(?string $time): ?Carbon
    {
        if (!$time) {
            return null;
        }

        return Carbon::today()->setTimeFromTimeString($time);
    }
 }

