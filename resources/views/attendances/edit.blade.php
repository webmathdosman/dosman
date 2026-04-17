<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold text-gray-800">Edit Absensi</h2></x-slot>
    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <form method="POST" action="{{ route('attendances.update', $attendance) }}" class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    @csrf
                    @method('PUT')
                    <select name="student_id" class="rounded-lg border-gray-300" required>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" @selected($attendance->student_id === $student->id)>{{ $student->full_name }}</option>
                        @endforeach
                    </select>
                    <input type="date" name="attendance_date" value="{{ $attendance->attendance_date?->format('Y-m-d') }}" class="rounded-lg border-gray-300" required>
                    <select name="status" class="rounded-lg border-gray-300" required>
                        @foreach (['present','sick','permit','absent'] as $status)
                            <option value="{{ $status }}" @selected($attendance->status === $status)>{{ strtoupper($status) }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="location_label" value="{{ $attendance->location_label }}" class="rounded-lg border-gray-300">
                    <div class="md:col-span-2 flex gap-2">
                        <x-ui.button type="submit">Update</x-ui.button>
                        <a href="{{ route('attendances.index') }}" class="inline-flex items-center rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-800">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
