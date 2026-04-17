<x-app-layout>
    <x-slot name="header"><h2 class="text-xl font-semibold text-gray-800">Edit Prestasi</h2></x-slot>
    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <form method="POST" action="{{ route('achievements.update', $achievement) }}" class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    @csrf
                    @method('PUT')
                    <select name="student_id" class="rounded-lg border-gray-300" required>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" @selected($achievement->student_id === $student->id)>{{ $student->full_name }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="title" value="{{ $achievement->title }}" class="rounded-lg border-gray-300" required>
                    <input type="number" name="points" min="1" max="500" value="{{ $achievement->points }}" class="rounded-lg border-gray-300" required>
                    <input type="date" name="achievement_date" value="{{ $achievement->achievement_date?->format('Y-m-d') }}" class="rounded-lg border-gray-300" required>
                    <input type="text" name="description" value="{{ $achievement->description }}" class="rounded-lg border-gray-300 md:col-span-2">
                    <div class="md:col-span-2 flex gap-2">
                        <x-ui.button type="submit">Update</x-ui.button>
                        <a href="{{ route('achievements.index') }}" class="inline-flex items-center rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-800">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
