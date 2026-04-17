<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentAchievementRequest;
use App\Http\Requests\UpdateStudentAchievementRequest;
use App\Models\Student;
use App\Models\StudentAchievement;
use App\Services\DisciplineService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentAchievementController extends Controller
{
    public function __construct(private readonly DisciplineService $disciplineService)
    {
    }

    public function index(Request $request): View
    {
        return view('achievements.index', [
            'achievements' => $this->disciplineService->latestAchievements($request->only([
                'student_id',
                'achievement_date',
            ])),
            'students' => Student::query()->orderBy('full_name')->get(),
            'filters' => $request->only(['student_id', 'achievement_date']),
        ]);
    }

    public function store(StoreStudentAchievementRequest $request): RedirectResponse
    {
        $this->disciplineService->createAchievement(
            $request->validated(),
            $request->user()?->id
        );

        return back()->with('status', 'Data prestasi berhasil disimpan.');
    }

    public function edit(StudentAchievement $achievement): View
    {
        return view('achievements.edit', [
            'achievement' => $achievement->load('student'),
            'students' => Student::query()->orderBy('full_name')->get(),
        ]);
    }

    public function update(UpdateStudentAchievementRequest $request, StudentAchievement $achievement): RedirectResponse
    {
        $this->disciplineService->updateAchievement($achievement, $request->validated());

        return redirect()->route('achievements.index')->with('status', 'Data prestasi berhasil diperbarui.');
    }

    public function destroy(StudentAchievement $achievement): RedirectResponse
    {
        $this->disciplineService->deleteAchievement($achievement);

        return back()->with('status', 'Data prestasi berhasil dihapus.');
    }
}
