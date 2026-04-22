@php
    $viteReady = file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'));
@endphp
@if ($viteReady)
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@else
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Figtree', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#eef4ff',
                            100: '#d9e6ff',
                            200: '#bcd3ff',
                            300: '#8fb3ff',
                            400: '#5f8fff',
                            500: '#3b70f2',
                            600: '#2959d6',
                            700: '#2348b4',
                            800: '#233f93',
                            900: '#213876',
                        },
                    },
                },
            },
        };
    </script>
    @verbatim
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('displayPrefs', () => ({
                    panelOpen: false,
                    menuOpen: false,
                    theme: 'system',
                    fontSize: 'md',
                    wideLayout: false,
                    systemDark: false,
                    _mq: null,
                    init() {
                        this.theme = localStorage.getItem('uiTheme') ?? 'system';
                        this.fontSize = localStorage.getItem('uiFontSize') ?? 'md';
                        this.wideLayout = (localStorage.getItem('uiWideLayout') ?? '0') === '1';
                        this.systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                        this._mq = window.matchMedia('(prefers-color-scheme: dark)');
                        this._mq.addEventListener('change', (e) => {
                            this.systemDark = e.matches;
                            this.applyThemeClass();
                        });
                        this.applyThemeClass();
                        this.applyFontSize();
                    },
                    get effectiveDark() {
                        if (this.theme === 'dark') return true;
                        if (this.theme === 'light') return false;
                        return this.systemDark;
                    },
                    applyThemeClass() {
                        document.documentElement.classList.toggle('dark', this.effectiveDark);
                    },
                    applyFontSize() {
                        const map = { sm: '93.75%', md: '100%', lg: '108%' };
                        document.documentElement.style.fontSize = map[this.fontSize] ?? map.md;
                    },
                    setTheme(value) {
                        this.theme = value;
                        localStorage.setItem('uiTheme', value);
                        this.applyThemeClass();
                    },
                    setFontSize(value) {
                        this.fontSize = value;
                        localStorage.setItem('uiFontSize', value);
                        this.applyFontSize();
                    },
                    toggleWideLayout() {
                        this.wideLayout = !this.wideLayout;
                        localStorage.setItem('uiWideLayout', this.wideLayout ? '1' : '0');
                    },
                }));
            });
        </script>
    @endverbatim
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>
@endif
