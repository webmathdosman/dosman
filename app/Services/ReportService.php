<?php

namespace App\Services;

use App\Models\Report;
use Illuminate\Support\Collection;

class ReportService
{
    public function create(array $payload, ?int $teacherId = null): Report
    {
        return Report::create([
            ...$payload,
            'teacher_id' => $teacherId,
        ]);
    }

    public function listLatest(array $filters = [], int $limit = 20): Collection
    {
        return Report::query()
            ->with(['student', 'subject'])
            ->when(
                filled($filters['student_id'] ?? null),
                fn ($query) => $query->where('student_id', (int) $filters['student_id'])
            )
            ->when(
                filled($filters['subject_id'] ?? null),
                fn ($query) => $query->where('subject_id', (int) $filters['subject_id'])
            )
            ->when(
                filled($filters['semester'] ?? null),
                fn ($query) => $query->where('semester', (int) $filters['semester'])
            )
            ->when(
                filled($filters['academic_year'] ?? null),
                fn ($query) => $query->where('academic_year', (string) $filters['academic_year'])
            )
            ->latest()
            ->limit($limit)
            ->get();
    }

    public function update(Report $report, array $payload): Report
    {
        $report->update($payload);

        return $report->refresh();
    }

    public function delete(Report $report): void
    {
        $report->delete();
    }
}
