<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Modul Absensi</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="rounded-lg bg-emerald-100 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>
            @endif

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h3 class="text-base font-semibold text-gray-800">Input Kehadiran</h3>
                <form method="POST" action="{{ route('attendances.store') }}" class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                    @csrf
                    <select name="student_id" class="rounded-lg border-gray-300" required>
                        <option value="">Pilih Siswa</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->full_name }}</option>
                        @endforeach
                    </select>
                    <input type="date" name="attendance_date" class="rounded-lg border-gray-300" required>
                    <select name="status" class="rounded-lg border-gray-300" required>
                        <option value="present">Hadir</option>
                        <option value="sick">Sakit</option>
                        <option value="permit">Izin</option>
                        <option value="absent">Alpa</option>
                    </select>
                    <input type="text" name="location_label" placeholder="Lokasi (opsional)" class="rounded-lg border-gray-300">
                    <div class="md:col-span-2 lg:col-span-4">
                        <x-ui.button type="submit">Simpan Absensi</x-ui.button>
                    </div>
                </form>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h3 class="text-base font-semibold text-gray-800">Riwayat Absensi</h3>
                <form method="GET" action="{{ route('attendances.index') }}" class="mt-3 grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-4">
                    <select name="student_id" class="rounded-lg border-gray-300">
                        <option value="">Semua Siswa</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" @selected(($filters['student_id'] ?? null) == $student->id)>{{ $student->full_name }}</option>
                        @endforeach
                    </select>
                    <select name="status" class="rounded-lg border-gray-300">
                        <option value="">Semua Status</option>
                        @foreach (['present' => 'Hadir', 'sick' => 'Sakit', 'permit' => 'Izin', 'absent' => 'Alpa'] as $key => $label)
                            <option value="{{ $key }}" @selected(($filters['status'] ?? null) === $key)>{{ $label }}</option>
                        @endforeach
                    </select>
                    <input type="date" name="attendance_date" value="{{ $filters['attendance_date'] ?? '' }}" class="rounded-lg border-gray-300">
                    <x-ui.button type="submit">Filter</x-ui.button>
                </form>
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="border-b text-left text-gray-500">
                            <tr>
                                <th class="px-3 py-2">Tanggal</th>
                                <th class="px-3 py-2">Siswa</th>
                                <th class="px-3 py-2">Status</th>
                                <th class="px-3 py-2">Lokasi</th>
                                <th class="px-3 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attendances as $attendance)
                                <tr class="border-b">
                                    <td class="px-3 py-2">{{ $attendance->attendance_date?->format('Y-m-d') }}</td>
                                    <td class="px-3 py-2">{{ $attendance->student->full_name ?? '-' }}</td>
                                    <td class="px-3 py-2">{{ $attendance->status }}</td>
                                    <td class="px-3 py-2">{{ $attendance->location_label ?? '-' }}</td>
                                    <td class="px-3 py-2">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('attendances.edit', $attendance) }}" class="text-brand-600 hover:underline">Edit</a>
                                            <form method="POST" action="{{ route('attendances.destroy', $attendance) }}" onsubmit="return confirm('Hapus data absensi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-600 hover:underline">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-3 py-4 text-center text-gray-500">Belum ada data absensi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
