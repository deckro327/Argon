<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Models\Worker;
use Illuminate\Support\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $attendances = Attendance::with('worker.area')->latest()->paginate(10);

        return view('attendance.index', compact('attendances'))
            ->with('i', (request()->input('page', 1) - 1) * $attendances->perPage());
    }

        public function create (Request $request)
        {
        $attendance = new Attendance();
            $workers = Worker::with('area')->get()->sortBy('id');
        $statuses = [
                'presente' => 'Presente',
            'justificado' => 'Justificado',
            'ausente' => 'Ausente',
        ];
        $workerAttendanceDefaults = $this->buildWorkerAttendanceDefaults($workers);
            $showAttendanceTimes = true;

        return view('attendance.create', compact('attendance', 'workers', 'statuses', 'workerAttendanceDefaults', 'showAttendanceTimes'));
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

    public function edit (Attendance $attendance)
    {
        $workers = Worker::with('area')->get()->sortBy('id');
        $statuses = [
            'presente' => 'Presente',
            'justificado' => 'Justificado',
            'ausente' => 'Ausente',
        ];
        $workerAttendanceDefaults = $this->buildWorkerAttendanceDefaults($workers);
        $showAttendanceTimes = true;

        return view('attendance.edit', compact('attendance', 'workers', 'statuses', 'workerAttendanceDefaults', 'showAttendanceTimes'));
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
            return [
                $worker->id => [
                    'label' => $worker->id.' - '.$worker->name.' '.$worker->surname,
                    'area_name' => $worker->area?->name,
                    'area_entry_time' => $worker->area?->punctuality
                        ? Carbon::parse($worker->area?->punctuality)->format('H:i')
                        : null,
                    'area_exit_time' => $worker->area?->departure
                        ? Carbon::parse($worker->area?->departure)->format('H:i')
                        : null,
                    'area_punctuality' => $worker->area?->punctuality
                        ? Carbon::parse($worker->area?->punctuality)->format('h:i A')
                        : null,
                    'area_departure' => $worker->area?->departure
                        ? Carbon::parse($worker->area?->departure)->format('h:i A')
                        : null,
                    'area_entry_display' => $worker->area?->punctuality
                        ? Carbon::parse($worker->area?->punctuality)->format('h:i A')
                        : null,
                    'area_exit_display' => $worker->area?->departure
                        ? Carbon::parse($worker->area?->departure)->format('h:i A')
                        : null,
                    'punctuality' => $worker->area?->punctuality
                        ? Carbon::parse($worker->area?->punctuality)->format('Y-m-d\TH:i')
                        : null,
                    'departure' => $worker->area?->departure
                        ? Carbon::parse($worker->area?->departure)->format('Y-m-d\TH:i')
                        : null,
                ],
            ];
        })->toArray();
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
            $data['punctuality'] = null;
            $data['departure'] = null;

            return $data;
        }

        if ($status === 'presente') {
            $data['punctuality'] = $this->timeToDateTime($data['punctuality'] ?? null);
            $data['departure'] = $this->timeToDateTime($data['departure'] ?? null);

            return $data;
        }

        return $data;
    }

//     private function timeToDateTime(?string $time): ?Carbon
//     {
//         if (!$time) {
//             return null;
//         }

//         return Carbon::today()->setTimeFromTimeString($time . ':00');
//     }
 }

