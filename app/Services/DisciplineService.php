<?php

namespace App\Services;

use App\Models\StudentAchievement;
use App\Models\StudentViolation;
use Illuminate\Support\Collection;

class DisciplineService
{
    public function createViolation(array $payload, ?int $teacherId = null): StudentViolation
    {
        return StudentViolation::create([
            ...$payload,
            'teacher_id' => $teacherId,
        ]);
    }

    public function createAchievement(array $payload, ?int $teacherId = null): StudentAchievement
    {
        return StudentAchievement::create([
            ...$payload,
            'teacher_id' => $teacherId,
        ]);
    }

    public function summarizePoints(int $studentId): array
    {
        $totalViolation = (int) StudentViolation::query()
            ->where('student_id', $studentId)
            ->sum('points');
        $totalAchievement = (int) StudentAchievement::query()
            ->where('student_id', $studentId)
            ->sum('points');

        return [
            'total_violation_points' => $totalViolation,
            'total_achievement_points' => $totalAchievement,
            'net_points' => $totalAchievement - $totalViolation,
        ];
    }

    public function latestViolations(array $filters = [], int $limit = 20): Collection
    {
        return StudentViolation::query()
            ->with('student')
            ->when(
                filled($filters['student_id'] ?? null),
                fn ($query) => $query->where('student_id', (int) $filters['student_id'])
            )
            ->when(
                filled($filters['violation_date'] ?? null),
                fn ($query) => $query->whereDate('violation_date', (string) $filters['violation_date'])
            )
            ->latest('violation_date')
            ->limit($limit)
            ->get();
    }

    public function latestAchievements(array $filters = [], int $limit = 20): Collection
    {
        return StudentAchievement::query()
            ->with('student')
            ->when(
                filled($filters['student_id'] ?? null),
                fn ($query) => $query->where('student_id', (int) $filters['student_id'])
            )
            ->when(
                filled($filters['achievement_date'] ?? null),
                fn ($query) => $query->whereDate('achievement_date', (string) $filters['achievement_date'])
            )
            ->latest('achievement_date')
            ->limit($limit)
            ->get();
    }

    public function updateViolation(StudentViolation $violation, array $payload): StudentViolation
    {
        $violation->update($payload);

        return $violation->refresh();
    }

    public function deleteViolation(StudentViolation $violation): void
    {
        $violation->delete();
    }

    public function updateAchievement(StudentAchievement $achievement, array $payload): StudentAchievement
    {
        $achievement->update($payload);

        return $achievement->refresh();
    }

    public function deleteAchievement(StudentAchievement $achievement): void
    {
        $achievement->delete();
    }
}
