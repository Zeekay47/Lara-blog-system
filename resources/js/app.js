// resources/js/app.js
import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Check for saved theme or system preference
if (localStorage.getItem('darkMode') === null) {
    // If no saved preference, check system preference
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    localStorage.setItem('darkMode', prefersDark);
    if (prefersDark) {
        document.documentElement.classList.add('dark');
    }
} else {
    // Use saved preference
    if (localStorage.getItem('darkMode') === 'true') {
        document.documentElement.classList.add('dark');
    }
}

Alpine.start();