<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class StudentViolation extends Model
{
    protected $fillable = [
        'student_id',
        'teacher_id',
        'title',
        'description',
        'points',
        'violation_date',
    ];

    protected function casts(): array
    {
        return [
            'violation_date' => 'date',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
