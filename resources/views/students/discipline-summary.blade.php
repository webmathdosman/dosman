<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Summary Poin Siswa</h2>
    </x-slot>
    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">{{ $student->full_name }}</h3>
                <p class="text-sm text-gray-500">{{ $student->classroom }} - NISN {{ $student->nisn }}</p>
                <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3">
                    <x-ui.card title="Total Poin Pelanggaran" :value="$summary['total_violation_points']" description="Akumulasi poin minus" />
                    <x-ui.card title="Total Poin Prestasi" :value="$summary['total_achievement_points']" description="Akumulasi poin plus" />
                    <x-ui.card title="Net Poin" :value="$summary['net_points']" description="Prestasi - Pelanggaran" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
