<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Modul Rapor</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="rounded-lg bg-emerald-100 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>
            @endif

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h3 class="text-base font-semibold text-gray-800">Input Nilai Rapor</h3>
                <form method="POST" action="{{ route('reports.store') }}" class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @csrf
                    <select name="student_id" class="rounded-lg border-gray-300" required>
                        <option value="">Pilih Siswa</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->full_name }} ({{ $student->classroom }})</option>
                        @endforeach
                    </select>
                    <select name="subject_id" class="rounded-lg border-gray-300" required>
                        <option value="">Pilih Mata Pelajaran</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="score" min="0" max="100" placeholder="Nilai (0-100)" class="rounded-lg border-gray-300" required>
                    <input type="number" name="semester" min="1" max="2" placeholder="Semester" class="rounded-lg border-gray-300" required>
                    <input type="text" name="academic_year" placeholder="Tahun Ajaran (2026/2027)" class="rounded-lg border-gray-300" required>
                    <input type="text" name="notes" placeholder="Catatan (opsional)" class="rounded-lg border-gray-300">
                    <div class="md:col-span-2 lg:col-span-3">
                        <x-ui.button type="submit">Simpan Rapor</x-ui.button>
                    </div>
                </form>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h3 class="text-base font-semibold text-gray-800">Daftar Rapor Terbaru</h3>
                <form method="GET" action="{{ route('reports.index') }}" class="mt-3 grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-5">
                    <select name="student_id" class="rounded-lg border-gray-300">
                        <option value="">Semua Siswa</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" @selected(($filters['student_id'] ?? null) == $student->id)>{{ $student->full_name }}</option>
                        @endforeach
                    </select>
                    <select name="subject_id" class="rounded-lg border-gray-300">
                        <option value="">Semua Mapel</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" @selected(($filters['subject_id'] ?? null) == $subject->id)>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" min="1" max="2" name="semester" value="{{ $filters['semester'] ?? '' }}" placeholder="Semester" class="rounded-lg border-gray-300">
                    <input type="text" name="academic_year" value="{{ $filters['academic_year'] ?? '' }}" placeholder="Tahun ajaran" class="rounded-lg border-gray-300">
                    <div class="flex gap-2">
                        <x-ui.button type="submit">Filter</x-ui.button>
                        <a href="{{ route('reports.export-pdf', request()->query()) }}" class="inline-flex items-center rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white hover:bg-rose-700">Export PDF</a>
                    </div>
                </form>
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="border-b text-left text-gray-500">
                            <tr>
                                <th class="px-3 py-2">Siswa</th>
                                <th class="px-3 py-2">Mapel</th>
                                <th class="px-3 py-2">Semester</th>
                                <th class="px-3 py-2">TA</th>
                                <th class="px-3 py-2">Nilai</th>
                                <th class="px-3 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reports as $report)
                                <tr class="border-b">
                                    <td class="px-3 py-2">{{ $report->student->full_name ?? '-' }}</td>
                                    <td class="px-3 py-2">{{ $report->subject->name ?? '-' }}</td>
                                    <td class="px-3 py-2">{{ $report->semester }}</td>
                                    <td class="px-3 py-2">{{ $report->academic_year }}</td>
                                    <td class="px-3 py-2">{{ $report->score }}</td>
                                    <td class="px-3 py-2">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('reports.edit', $report) }}" class="text-brand-600 hover:underline">Edit</a>
                                            <form method="POST" action="{{ route('reports.destroy', $report) }}" onsubmit="return confirm('Hapus data rapor ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-600 hover:underline">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-3 py-4 text-center text-gray-500">Belum ada data rapor.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
