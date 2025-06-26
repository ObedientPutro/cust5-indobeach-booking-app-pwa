importScripts('https://storage.googleapis.com/workbox-cdn/releases/6.4.1/workbox-sw.js');

if (workbox) {
    // ======================================================
    // BAGIAN CACHING DENGAN WORKBOX
    // ======================================================
    console.log(`Workbox berhasil dimuat!`);

    // STRATEGI 1: PRECACHE (Cache First untuk Aset Inti Aplikasi)
    workbox.precaching.precacheAndRoute(self.__WB_MANIFEST || []);

    // STRATEGI 2: Cache First untuk Landing Page & Aset Gambar/Font
    workbox.routing.registerRoute(
        ({ request, url }) => request.destination === 'document' && url.pathname === '/',
        new workbox.strategies.CacheFirst({ cacheName: 'landing-page-cache' })
    );
    workbox.routing.registerRoute(
        ({ request }) => request.destination === 'image' || request.destination === 'font',
        new workbox.strategies.CacheFirst({
            cacheName: 'static-assets-cache',
            plugins: [
                new workbox.cacheableResponse.CacheableResponsePlugin({ statuses: [0, 200] }),
                new workbox.expiration.ExpirationPlugin({ maxEntries: 50, maxAgeSeconds: 30 * 24 * 60 * 60 }), // 30 Hari
            ],
        })
    );

    // STRATEGI 3: Stale-While-Revalidate untuk Halaman Gazebo
    workbox.routing.registerRoute(
        ({ request, url }) => request.destination === 'document' && url.pathname.startsWith('/gazebo'),
        new workbox.strategies.StaleWhileRevalidate({ cacheName: 'gazebo-pages-cache' })
    );

    // STRATEGI 4: Network Only untuk Fitur yang Memerlukan Login
    workbox.routing.registerRoute(
        ({ url }) => url.pathname.startsWith('/booking') || url.pathname.startsWith('/admin'),
        new workbox.strategies.NetworkOnly()
    );

    // STRATEGI DEFAULT: Network First untuk permintaan lainnya
    workbox.routing.setDefaultHandler(new workbox.strategies.NetworkFirst());

} else {
    console.log(`Workbox gagal dimuat.`);
}

// ======================================================
// EVENT LISTENER UNTUK PUSH NOTIFICATION
// ======================================================

// Listener saat ada push notification masuk dari server
self.addEventListener('push', function (event) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        return;
    }

    const data = event.data?.json() ?? {};
    const title = data.title || 'IndoBeach Resort';
    const message = data.body || 'Anda memiliki pesan baru.';
    const icon = data.icon || '/images/icons/icon-192x192.png';
    const notificationData = data.data || {};

    const options = {
        body: message,
        icon: icon,
        badge: '/images/icons/icon-96x96.png',
        data: notificationData,
    };

    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});

// Listener saat pengguna mengklik notifikasi
self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    const urlToOpen = event.notification.data?.url;

    if (urlToOpen) {
        event.waitUntil(
            clients.matchAll({ type: 'window', includeUncontrolled: true })
                .then(windowClients => {
                    let clientIsFocused = false;
                    for (let i = 0; i < windowClients.length; i++) {
                        const client = windowClients[i];
                        if (client.url === urlToOpen && 'focus' in client) {
                            client.focus();
                            clientIsFocused = true;
                            break;
                        }
                    }
                    if (!clientIsFocused && clients.openWindow) {
                        return clients.openWindow(urlToOpen);
                    }
                })
        );
    }
});

