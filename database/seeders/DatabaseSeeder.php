<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@school.test'],
            [
                'name' => 'Super Admin',
                'password' => 'password',
                'role' => UserRole::SuperAdmin,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'guru@school.test'],
            [
                'name' => 'Guru Demo',
                'password' => 'password',
                'role' => UserRole::Teacher,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'siswa@school.test'],
            [
                'name' => 'Siswa Demo',
                'password' => 'password',
                'role' => UserRole::Student,
            ]
        );

        $this->call([
            SubjectSeeder::class,
            StudentSeeder::class,
        ]);
    }
}
