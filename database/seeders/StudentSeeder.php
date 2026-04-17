<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            ['nisn' => '2026000001', 'full_name' => 'I Made Aditya', 'classroom' => 'X IPA 1'],
            ['nisn' => '2026000002', 'full_name' => 'Ni Luh Sari', 'classroom' => 'X IPA 1'],
            ['nisn' => '2026000003', 'full_name' => 'Kadek Putri', 'classroom' => 'X IPS 2'],
            ['nisn' => '2026000004', 'full_name' => 'Komang Yoga', 'classroom' => 'XI IPS 1'],
            ['nisn' => '2026000005', 'full_name' => 'Putu Nanda', 'classroom' => 'XI IPA 3'],
        ];

        foreach ($students as $student) {
            Student::query()->updateOrCreate(
                ['nisn' => $student['nisn']],
                $student
            );
        }
    }
}
