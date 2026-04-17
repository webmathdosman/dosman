<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Modul Prestasi Siswa</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="rounded-lg bg-emerald-100 px-4 py-3 text-sm text-emerald-700">{{ session('status') }}</div>
            @endif

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h3 class="text-base font-semibold text-gray-800">Input Prestasi</h3>
                <form method="POST" action="{{ route('achievements.store') }}" class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                    @csrf
                    <select name="student_id" class="rounded-lg border-gray-300" required>
                        <option value="">Pilih Siswa</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->full_name }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="title" placeholder="Judul Prestasi" class="rounded-lg border-gray-300" required>
                    <input type="number" name="points" min="1" max="500" placeholder="Poin" class="rounded-lg border-gray-300" required>
                    <input type="date" name="achievement_date" class="rounded-lg border-gray-300" required>
                    <input type="text" name="description" placeholder="Deskripsi" class="rounded-lg border-gray-300 md:col-span-2 lg:col-span-4">
                    <div class="md:col-span-2 lg:col-span-4">
                        <x-ui.button type="submit">Simpan Prestasi</x-ui.button>
                    </div>
                </form>
            </div>

            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h3 class="text-base font-semibold text-gray-800">Riwayat Prestasi</h3>
                <form method="GET" action="{{ route('achievements.index') }}" class="mt-3 grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-3">
                    <select name="student_id" class="rounded-lg border-gray-300">
                        <option value="">Semua Siswa</option>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" @selected(($filters['student_id'] ?? null) == $student->id)>{{ $student->full_name }}</option>
                        @endforeach
                    </select>
                    <input type="date" name="achievement_date" value="{{ $filters['achievement_date'] ?? '' }}" class="rounded-lg border-gray-300">
                    <x-ui.button type="submit">Filter</x-ui.button>
                </form>
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="border-b text-left text-gray-500">
                            <tr>
                                <th class="px-3 py-2">Tanggal</th>
                                <th class="px-3 py-2">Siswa</th>
                                <th class="px-3 py-2">Judul</th>
                                <th class="px-3 py-2">Poin</th>
                                <th class="px-3 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($achievements as $achievement)
                                <tr class="border-b">
                                    <td class="px-3 py-2">{{ $achievement->achievement_date?->format('Y-m-d') }}</td>
                                    <td class="px-3 py-2">{{ $achievement->student->full_name ?? '-' }}</td>
                                    <td class="px-3 py-2">{{ $achievement->title }}</td>
                                    <td class="px-3 py-2">{{ $achievement->points }}</td>
                                    <td class="px-3 py-2">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('achievements.edit', $achievement) }}" class="text-brand-600 hover:underline">Edit</a>
                                            <a href="{{ route('students.discipline-summary', $achievement->student_id) }}" class="text-emerald-600 hover:underline">Summary</a>
                                            <form method="POST" action="{{ route('achievements.destroy', $achievement) }}" onsubmit="return confirm('Hapus data prestasi ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-rose-600 hover:underline">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-3 py-4 text-center text-gray-500">Belum ada data prestasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
