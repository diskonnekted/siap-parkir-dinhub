/* SIAP Mobile PWA - Survei Lapangan */
const CACHE = 'siap-mobile-v1';
const CORE = [
  '/m/survei',
  '/assets/pwa/manifest.webmanifest',
  '/template/bootstrap/css/bootstrap.min.css',
  '/template/css/font-awesome/css/font-awesome.min.css',
  '/template/js/jquery.min.js',
  '/assets/pub/img/logo.png'
];

self.addEventListener('install', (e) => {
  e.waitUntil(caches.open(CACHE).then((c) => c.addAll(CORE)).then(() => self.skipWaiting()));
});

self.addEventListener('activate', (e) => {
  e.waitUntil(
    caches.keys().then((keys) => Promise.all(keys.map((k) => (k === CACHE ? null : caches.delete(k)))))
      .then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', (e) => {
  const req = e.request;
  const url = new URL(req.url);
  if (url.origin !== self.location.origin) return;

  // Jangan cache request POST/action (form sinkronisasi)
  if (req.method !== 'GET') return;

  // Navigasi halaman: network-first, fallback ke cache
  if (req.mode === 'navigate') {
    e.respondWith(
      fetch(req).then((res) => {
        const copy = res.clone();
        caches.open(CACHE).then((c) => c.put(req, copy));
        return res;
      }).catch(() => caches.match(req).then((r) => r || caches.match('/m/survei')))
    );
    return;
  }

  // Aset statis: cache-first
  e.respondWith(
    caches.match(req).then((cached) => cached || fetch(req).then((res) => {
      const copy = res.clone();
      caches.open(CACHE).then((c) => c.put(req, copy));
      return res;
    }))
  );
});
