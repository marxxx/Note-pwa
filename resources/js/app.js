import './bootstrap';

// Register Service Worker for PWA
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').then(registration => {
            console.log('SW registered: ', registration);
        }).catch(registrationError => {
            console.log('SW registration failed: ', registrationError);
        });
    });
}

// Logic to resize the PWA window on desktop
if (window.matchMedia('(display-mode: standalone)').matches) {
    window.resizeTo(450, 800);
}