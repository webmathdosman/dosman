<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Models\Student;
use App\Services\AttendanceService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttendanceController extends Controller
{
    public function __construct(private readonly AttendanceService $attendanceService)
    {
    }

    public function index(Request $request): View
    {
        return view('attendances.index', [
            'attendances' => $this->attendanceService->listLatest($request->only([
                'student_id',
                'status',
                'attendance_date',
            ])),
            'students' => Student::query()->orderBy('full_name')->get(),
            'filters' => $request->only(['student_id', 'status', 'attendance_date']),
        ]);
    }

    public function store(StoreAttendanceRequest $request): RedirectResponse
    {
        $this->attendanceService->create(
            $request->validated(),
            $request->user()?->id
        );

        return back()->with('status', 'Data absensi berhasil disimpan.');
    }

    public function edit(Attendance $attendance): View
    {
        return view('attendances.edit', [
            'attendance' => $attendance->load('student'),
            'students' => Student::query()->orderBy('full_name')->get(),
        ]);
    }

    public function update(UpdateAttendanceRequest $request, Attendance $attendance): RedirectResponse
    {
        $this->attendanceService->update($attendance, $request->validated());

        return redirect()->route('attendances.index')->with('status', 'Data absensi berhasil diperbarui.');
    }

    public function destroy(Attendance $attendance): RedirectResponse
    {
        $this->attendanceService->delete($attendance);

        return back()->with('status', 'Data absensi berhasil dihapus.');
    }
}
