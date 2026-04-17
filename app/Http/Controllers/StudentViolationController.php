<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentViolationRequest;
use App\Http\Requests\UpdateStudentViolationRequest;
use App\Models\Student;
use App\Models\StudentViolation;
use App\Services\DisciplineService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentViolationController extends Controller
{
    public function __construct(private readonly DisciplineService $disciplineService)
    {
    }

    public function index(Request $request): View
    {
        return view('violations.index', [
            'violations' => $this->disciplineService->latestViolations($request->only([
                'student_id',
                'violation_date',
            ])),
            'students' => Student::query()->orderBy('full_name')->get(),
            'filters' => $request->only(['student_id', 'violation_date']),
        ]);
    }

    public function store(StoreStudentViolationRequest $request): RedirectResponse
    {
        $this->disciplineService->createViolation(
            $request->validated(),
            $request->user()?->id
        );

        return back()->with('status', 'Data pelanggaran berhasil disimpan.');
    }

    public function edit(StudentViolation $violation): View
    {
        return view('violations.edit', [
            'violation' => $violation->load('student'),
            'students' => Student::query()->orderBy('full_name')->get(),
        ]);
    }

    public function update(UpdateStudentViolationRequest $request, StudentViolation $violation): RedirectResponse
    {
        $this->disciplineService->updateViolation($violation, $request->validated());

        return redirect()->route('violations.index')->with('status', 'Data pelanggaran berhasil diperbarui.');
    }

    public function destroy(StudentViolation $violation): RedirectResponse
    {
        $this->disciplineService->deleteViolation($violation);

        return back()->with('status', 'Data pelanggaran berhasil dihapus.');
    }
}
