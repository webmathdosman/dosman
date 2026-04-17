<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Services\DisciplineService;
use Illuminate\View\View;

class StudentDisciplineSummaryController extends Controller
{
    public function __construct(private readonly DisciplineService $disciplineService)
    {
    }

    public function show(Student $student): View
    {
        return view('students.discipline-summary', [
            'student' => $student,
            'summary' => $this->disciplineService->summarizePoints($student->id),
        ]);
    }
}
