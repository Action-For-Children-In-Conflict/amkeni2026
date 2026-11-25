/*
 * AfCiC service worker.
 *
 * Strategy:
 *  - Navigation requests: network first, cached page as fallback, offline page last.
 *  - Static assets (css/js/images/fonts/uploads): stale-while-revalidate.
 *  - Never touches admin, auth, Livewire or API requests.
 *
 * Bump CACHE_VERSION when the precache list or strategies change so old
 * caches are discarded on activate.
 */

const CACHE_VERSION = 'v1';
const PRECACHE = `afcic-precache-${CACHE_VERSION}`;
const RUNTIME = `afcic-runtime-${CACHE_VERSION}`;

const OFFLINE_URL = '/offline.html';

const PRECACHE_URLS = [
    OFFLINE_URL,
    '/favicon.ico',
    '/favicon-16x16.png',
    '/favicon-32x32.png',
    '/apple-touch-icon.png',
    '/android-chrome-192x192.png',
    '/images/assets/logo.png',
    '/frontend/css/styles.css',
    '/frontend/bootstrap/css/bootstrap.min.css',
    '/frontend/bootstrap/js/bootstrap.bundle.min.js',
];

// Paths that must always hit the network untouched.
const BYPASS_PREFIXES = [
    '/admin',
    '/api',
    '/livewire',
    '/settings',
    '/user',
    '/dashboard',
    '/login',
    '/logout',
    '/register',
    '/forgot-password',
    '/reset-password',
    '/verify-email',
    '/confirm-password',
    '/two-factor-challenge',
];

const STATIC_PREFIXES = ['/build/', '/frontend/', '/images/', '/storage/'];

const STATIC_EXTENSIONS = /\.(?:css|js|mjs|json|png|jpe?g|gif|webp|avif|svg|ico|woff2?|ttf|eot)$/i;

self.addEventListener('install', (event) => {
    event.waitUntil(
        (async () => {
            const cache = await caches.open(PRECACHE);

            // Individual adds so a single missing file cannot fail the install.
            await Promise.all(
                PRECACHE_URLS.map((url) =>
                    cache.add(new Request(url, { cache: 'reload' })).catch(() => null),
                ),
            );

            await self.skipWaiting();
        })(),
    );
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        (async () => {
            const keys = await caches.keys();

            await Promise.all(
                keys
                    .filter((key) => key !== PRECACHE && key !== RUNTIME)
                    .map((key) => caches.delete(key)),
            );

            await self.clients.claim();
        })(),
    );
});

self.addEventListener('message', (event) => {
    if (event.data && event.data.type === 'SKIP_WAITING') {
        self.skipWaiting();
    }
});

self.addEventListener('fetch', (event) => {
    const { request } = event;

    if (request.method !== 'GET') {
        return;
    }

    const url = new URL(request.url);

    if (url.origin !== self.location.origin) {
        return;
    }

    if (BYPASS_PREFIXES.some((prefix) => url.pathname.startsWith(prefix))) {
        return;
    }

    if (request.mode === 'navigate') {
        event.respondWith(networkFirst(request));

        return;
    }

    if (isStatic(url.pathname)) {
        event.respondWith(staleWhileRevalidate(request));
    }
});

function isStatic(pathname) {
    return (
        STATIC_PREFIXES.some((prefix) => pathname.startsWith(prefix)) ||
        STATIC_EXTENSIONS.test(pathname)
    );
}

async function networkFirst(request) {
    const cache = await caches.open(RUNTIME);

    try {
        const response = await fetch(request);

        if (response && response.ok && response.type === 'basic') {
            cache.put(request, response.clone());
        }

        return response;
    } catch (error) {
        const cached = (await cache.match(request, { ignoreSearch: true })) || (await caches.match(request));

        if (cached) {
            return cached;
        }

        const offline = await caches.match(OFFLINE_URL);

        if (offline) {
            return offline;
        }

        return new Response('You are offline.', {
            status: 503,
            headers: { 'Content-Type': 'text/plain; charset=utf-8' },
        });
    }
}

async function staleWhileRevalidate(request) {
    const cache = await caches.open(RUNTIME);
    const cached = await cache.match(request);

    const network = fetch(request)
        .then((response) => {
            if (response && response.ok) {
                cache.put(request, response.clone());
            }

            return response;
        })
        .catch(() => null);

    return cached || (await network) || Response.error();
}
