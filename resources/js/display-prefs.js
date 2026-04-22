/**
 * Pengaturan tampilan (tema, teks, lebar) — disimpan di localStorage.
 * Jika mengubah logika ini, sesuaikan juga salinan di `resources/views/partials/head-assets.blade.php` (cabang CDN tanpa Vite).
 */
export function registerDisplayPrefs(Alpine) {
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
            if (this.theme === 'dark') {
                return true;
            }
            if (this.theme === 'light') {
                return false;
            }

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
            this.wideLayout = ! this.wideLayout;
            localStorage.setItem('uiWideLayout', this.wideLayout ? '1' : '0');
        },
    }));
}
