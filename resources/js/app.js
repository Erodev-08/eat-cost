import './bootstrap';

import Alpine from 'alpinejs';

// Theme management (Dark / Light mode)
const initTheme = () => {
    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const isDark = savedTheme === 'dark' || (!savedTheme && systemPrefersDark);

    if (isDark) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
};

window.toggleDarkMode = function () {
    const isDark = document.documentElement.classList.toggle('dark');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    window.dispatchEvent(new CustomEvent('theme-changed', { detail: { isDark } }));
};

// Listen for OS theme changes if user hasn't explicitly set a preference
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    if (!localStorage.getItem('theme')) {
        if (e.matches) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
});

// Run theme check immediately
initTheme();
window.Alpine = Alpine;

Alpine.start();
