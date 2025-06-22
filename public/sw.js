importScripts('https://storage.googleapis.com/workbox-cdn/releases/6.4.1/workbox-sw.js');

if (workbox) {
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
        ({ url }) => url.pathname.startsWith('/booking') || url.pathname.startsWith('/admin') || url.pathname.startsWith('/login') || url.pathname.startsWith('/register'),
        new workbox.strategies.NetworkOnly()
    );

    // STRATEGI DEFAULT: Network First untuk permintaan lainnya
    workbox.routing.setDefaultHandler(new workbox.strategies.NetworkFirst());

} else {
    console.log(`Workbox gagal dimuat.`);
}
