import { onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';

export function usePushNotifications() {

    const page = usePage();
    const user = page.props.auth.user;

    // FUNGSI BARU: Mengonversi ArrayBuffer ke string Base64Url
    function arrayBufferToBase64(buffer) {
        let binary = '';
        const bytes = new Uint8Array(buffer);
        const len = bytes.byteLength;
        for (let i = 0; i < len; i++) {
            binary += String.fromCharCode(bytes[i]);
        }
        return window.btoa(binary)
            .replace(/\+/g, '-')
            .replace(/\//g, '_')
            .replace(/=+$/, '');
    }

    // PERBAIKAN: Fungsi subscribe sekarang membangun payload secara manual
    async function subscribeUserToPush() {
        try {
            const registration = await navigator.serviceWorker.ready;

            let subscription = await registration.pushManager.getSubscription();
            if (subscription) {
                console.log('User is already subscribed.');
                return;
            }

            const vapidPublicKey = document.getElementById('app').dataset.vapidPublicKey;
            if (!vapidPublicKey) {
                console.error('VAPID public key not found.');
                return;
            }

            subscription = await registration.pushManager.subscribe({
                userVisibleOnly: true,
                applicationServerKey: vapidPublicKey
            });

            const p256dh = subscription.getKey('p256dh');
            const auth = subscription.getKey('auth');

            const payload = {
                endpoint: subscription.endpoint,
                p256dh: arrayBufferToBase64(p256dh),
                auth: arrayBufferToBase64(auth),
            };

            await axios.post(route('push.store'), payload);
            console.log('User subscribed successfully with manual payload.');

        } catch (error) {
            console.error('Failed to subscribe the user:', error);
        }
    }

    onMounted(() => {
        // Logika onMounted tetap sama seperti sebelumnya
        if ('serviceWorker' in navigator && 'PushManager' in window) {
            navigator.serviceWorker.register('/sw.js')
                .then(registration => {
                    console.log('Service Worker: Berhasil didaftarkan.');
                    if (!user) return;

                    if (Notification.permission === 'granted') {
                        subscribeUserToPush();
                    } else if (Notification.permission === 'default') {
                        setTimeout(() => {
                            Notification.requestPermission().then(permission => {
                                if (permission === 'granted') {
                                    subscribeUserToPush();
                                }
                            });
                        }, 5000);
                    }
                })
                .catch(error => {
                    console.log('Service Worker: Pendaftaran gagal:', error);
                });
        }
    });
}
