<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard Sistem Sekolah
            </h2>
            <x-ui.badge variant="info">Aktif</x-ui.badge>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                <x-ui.card title="Jumlah Siswa" value="1,240" description="Total siswa aktif tahun ini" />
                <x-ui.card title="Kehadiran Hari Ini" value="93%" description="Rata-rata seluruh kelas" />
                <x-ui.card title="Pelanggaran Aktif" value="16" description="Perlu tindak lanjut BK" />
                <x-ui.card title="Jadwal CBT" value="3" description="Ujian berlangsung minggu ini" />
            </div>

            <div class="mt-6 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-200">
                <h3 class="text-base font-semibold text-gray-800">Aksi Cepat</h3>
                <p class="mt-1 text-sm text-gray-600">
                    Pilih menu utama untuk mengelola rapor, absensi, dan evaluasi siswa.
                </p>
                <div class="mt-4 flex flex-wrap gap-3">
                    <x-ui.button>Input Rapor</x-ui.button>
                    <x-ui.button variant="secondary">Kelola Absensi</x-ui.button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
