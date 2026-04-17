<?php

namespace App\Services;

use App\Models\Attendance;
use Illuminate\Support\Collection;

class AttendanceService
{
    public function create(array $payload, ?int $teacherId = null): Attendance
    {
        return Attendance::create([
            ...$payload,
            'teacher_id' => $teacherId,
        ]);
    }

    public function listLatest(array $filters = [], int $limit = 20): Collection
    {
        return Attendance::query()
            ->with('student')
            ->when(
                filled($filters['student_id'] ?? null),
                fn ($query) => $query->where('student_id', (int) $filters['student_id'])
            )
            ->when(
                filled($filters['status'] ?? null),
                fn ($query) => $query->where('status', (string) $filters['status'])
            )
            ->when(
                filled($filters['attendance_date'] ?? null),
                fn ($query) => $query->whereDate('attendance_date', (string) $filters['attendance_date'])
            )
            ->latest('attendance_date')
            ->limit($limit)
            ->get();
    }

    public function update(Attendance $attendance, array $payload): Attendance
    {
        $attendance->update($payload);

        return $attendance->refresh();
    }

    public function delete(Attendance $attendance): void
    {
        $attendance->delete();
    }

    public function calculatePercentage(int $totalPresent, int $totalMeeting): float
    {
        if ($totalMeeting <= 0) {
            return 0.0;
        }

        return round(($totalPresent / $totalMeeting) * 100, 2);
    }

    public function summarizeMonthly(Collection $attendanceRows): array
    {
        $present = (int) $attendanceRows->where('status', 'present')->count();
        $meeting = (int) $attendanceRows->count();

        return [
            'present' => $present,
            'meeting' => $meeting,
            'percentage' => $this->calculatePercentage($present, $meeting),
        ];
    }
}
