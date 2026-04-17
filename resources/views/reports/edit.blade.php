<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Edit Rapor</h2>
    </x-slot>
    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <form method="POST" action="{{ route('reports.update', $report) }}" class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    @csrf
                    @method('PUT')
                    <select name="student_id" class="rounded-lg border-gray-300" required>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" @selected($report->student_id === $student->id)>{{ $student->full_name }}</option>
                        @endforeach
                    </select>
                    <select name="subject_id" class="rounded-lg border-gray-300" required>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" @selected($report->subject_id === $subject->id)>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="score" min="0" max="100" value="{{ $report->score }}" class="rounded-lg border-gray-300" required>
                    <input type="number" name="semester" min="1" max="2" value="{{ $report->semester }}" class="rounded-lg border-gray-300" required>
                    <input type="text" name="academic_year" value="{{ $report->academic_year }}" class="rounded-lg border-gray-300" required>
                    <input type="text" name="notes" value="{{ $report->notes }}" class="rounded-lg border-gray-300">
                    <div class="md:col-span-2 flex gap-2">
                        <x-ui.button type="submit">Update</x-ui.button>
                        <a href="{{ route('reports.index') }}" class="inline-flex items-center rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-800">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
