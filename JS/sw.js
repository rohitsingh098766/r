const staticCache = 'static-v1';
// const dynamicCache = 'dynamic-v4';
const assets = [
  '../CSS/style.css',
  'https://yaarme.com/SVG/moon-solid.svg',
];

// Cache size limiting functiom
const limitCache = (name, size) => {
  caches.open(name).then(cache => {
    cache.keys().then(keys => {
      if (keys.length > size) {
        cache.delete(keys[0]).then(limitCache(name, size));
      }
    })
  })
}

// 'install' event handler
self.addEventListener('install', evt => {
  console.log("Service worker installed");
  evt.waitUntil(
    caches.open(staticCache)
      .then(cache => {
        cache.addAll(assets)
          .then(console.log("Assets Cached")
          );
      }).catch(err => {
        console.log(err);
      })
  );
});

// 'activate' event handler
self.addEventListener('activate', evt => {
  console.log("Service worker activated");
  evt.waitUntil(
    caches.keys().then(keys => {
      return Promise.all(
        keys.filter(key => key !== staticCache)
          .map(key => caches.delete(key))
      );
    })
  )
});

// 'fetch' event handler
self.addEventListener('fetch', evt => {
  evt.respondWith(
    caches.match(evt.request).then(res => {
      return res ||
        fetch(evt.request).then(async fetchRes => {
        //   const cache = await caches.open(dynamicCache);
        //   cache.put(evt.request.url, fetchRes.clone());
        //   limitCache(dynamicCache, 8);
          return fetchRes;
        });
    }).catch((err) => {
      console.log(err);
    })
  );
});



