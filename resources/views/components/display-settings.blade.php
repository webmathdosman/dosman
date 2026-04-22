{{-- Gunakan di dalam <body> yang sudah memiliki x-data="displayPrefs()" --}}
<div
    class="fixed bottom-4 end-4 z-50 flex flex-col items-end gap-2 print:hidden"
    aria-live="polite"
>
    <div
        id="display-settings-panel"
        x-show="panelOpen"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        x-cloak
        class="w-[min(100vw-2rem,20rem)] rounded-xl border border-gray-200 bg-white p-4 text-sm shadow-lg dark:border-gray-600 dark:bg-gray-800"
        @click.outside="panelOpen = false"
    >
        <h2 class="text-base font-semibold text-gray-900 dark:text-gray-100">Pengaturan tampilan</h2>
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Preferensi disimpan di perangkat Anda.</p>

        <div class="mt-4 space-y-4">
            <div>
                <span class="mb-2 block text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Tema</span>
                <div class="flex flex-wrap gap-2">
                    <button
                        type="button"
                        class="rounded-lg border px-3 py-1.5 text-xs font-medium transition"
                        :class="theme === 'light' ? 'border-brand-500 bg-brand-50 text-brand-800 dark:bg-brand-900/40 dark:text-brand-100' : 'border-gray-200 bg-white hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600'"
                        @click="setTheme('light')"
                    >
                        Terang
                    </button>
                    <button
                        type="button"
                        class="rounded-lg border px-3 py-1.5 text-xs font-medium transition"
                        :class="theme === 'dark' ? 'border-brand-500 bg-brand-50 text-brand-800 dark:bg-brand-900/40 dark:text-brand-100' : 'border-gray-200 bg-white hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600'"
                        @click="setTheme('dark')"
                    >
                        Gelap
                    </button>
                    <button
                        type="button"
                        class="rounded-lg border px-3 py-1.5 text-xs font-medium transition"
                        :class="theme === 'system' ? 'border-brand-500 bg-brand-50 text-brand-800 dark:bg-brand-900/40 dark:text-brand-100' : 'border-gray-200 bg-white hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600'"
                        @click="setTheme('system')"
                    >
                        Sistem
                    </button>
                </div>
            </div>

            <div>
                <span class="mb-2 block text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Ukuran teks</span>
                <div class="flex flex-wrap gap-2">
                    <button
                        type="button"
                        class="rounded-lg border px-3 py-1.5 text-xs font-medium transition"
                        :class="fontSize === 'sm' ? 'border-brand-500 bg-brand-50 text-brand-800 dark:bg-brand-900/40 dark:text-brand-100' : 'border-gray-200 bg-white hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600'"
                        @click="setFontSize('sm')"
                    >
                        Kecil
                    </button>
                    <button
                        type="button"
                        class="rounded-lg border px-3 py-1.5 text-xs font-medium transition"
                        :class="fontSize === 'md' ? 'border-brand-500 bg-brand-50 text-brand-800 dark:bg-brand-900/40 dark:text-brand-100' : 'border-gray-200 bg-white hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600'"
                        @click="setFontSize('md')"
                    >
                        Normal
                    </button>
                    <button
                        type="button"
                        class="rounded-lg border px-3 py-1.5 text-xs font-medium transition"
                        :class="fontSize === 'lg' ? 'border-brand-500 bg-brand-50 text-brand-800 dark:bg-brand-900/40 dark:text-brand-100' : 'border-gray-200 bg-white hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600'"
                        @click="setFontSize('lg')"
                    >
                        Besar
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between gap-3 rounded-lg border border-gray-100 bg-gray-50 px-3 py-2 dark:border-gray-600 dark:bg-gray-900/50">
                <span class="text-xs font-medium text-gray-700 dark:text-gray-300">Lebar konten lebar</span>
                <button
                    type="button"
                    role="switch"
                    :aria-checked="wideLayout"
                    class="relative inline-flex h-6 w-11 shrink-0 rounded-full border-2 border-transparent transition-colors focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                    :class="wideLayout ? 'bg-brand-600' : 'bg-gray-300 dark:bg-gray-600'"
                    @click="toggleWideLayout()"
                >
                    <span
                        class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow transition"
                        :class="wideLayout ? 'translate-x-5' : 'translate-x-0'"
                    ></span>
                </button>
            </div>
        </div>
    </div>

    <button
        type="button"
        class="flex h-12 w-12 items-center justify-center rounded-full bg-brand-600 text-white shadow-lg ring-2 ring-white transition hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 dark:ring-gray-800 dark:focus:ring-offset-gray-900"
        :class="panelOpen ? 'ring-brand-200' : ''"
        @click="panelOpen = !panelOpen"
        :aria-expanded="panelOpen"
        aria-controls="display-settings-panel"
        title="Pengaturan tampilan"
    >
        <span class="sr-only">Buka pengaturan tampilan</span>
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"
            />
        </svg>
    </button>
</div>
