const CACHE = 'sth-v1';
const STATIC = ['/'];

self.addEventListener('install', (e) => {
    self.skipWaiting();
    e.waitUntil(
        caches.open(CACHE).then(c => c.addAll(STATIC).catch(() => {}))
    );
});

self.addEventListener('activate', (e) => {
    e.waitUntil(
        Promise.all([
            self.clients.claim(),
            caches.keys().then(keys =>
                Promise.all(keys.filter(k => k !== CACHE).map(k => caches.delete(k)))
            ),
        ])
    );
});

self.addEventListener('fetch', (e) => {
    if (e.request.method !== 'GET') return;

    const url = e.request.url;
    if (url.includes('/api/') || url.includes('/admin/') || url.includes('/login') || url.includes('/setup/')) return;

    // Cache-first for static assets
    if (/\.(woff2?|ttf|eot|svg|png|jpg|webp|ico|css|js)(\?|$)/.test(url)) {
        e.respondWith(
            caches.match(e.request).then(cached => {
                if (cached) return cached;
                return fetch(e.request).then(res => {
                    if (res.ok) {
                        const clone = res.clone();
                        caches.open(CACHE).then(c => c.put(e.request, clone));
                    }
                    return res;
                }).catch(() => cached);
            })
        );
        return;
    }

    // Network-first for HTML pages
    e.respondWith(
        fetch(e.request).catch(() => caches.match(e.request))
    );
});
