const preLoad = async function () {
  const cache = await caches.open('offline');
  return await cache.addAll(filesToCache);
};

self.addEventListener('install', function (event) {
  event.waitUntil(preLoad());
});

const filesToCache = ['/', '/offline.html'];

const checkResponse = function (request) {
  return new Promise(function (fulfill, reject) {
    fetch(request).then(function (response) {
      if (response.status !== 404) {
        fulfill(response);
      } else {
        reject();
      }
    }, reject);
  });
};

const addToCache = async function (request) {
  if (request.url.startsWith('chrome-extension://')) {
    return Promise.resolve(); // Skip caching for chrome-extension URLs
  }

  const cache = await caches.open('offline');
  const response = await fetch(request);
  return await cache.put(request, response);
};

const returnFromCache = async function (request) {
  const cache = await caches.open('offline');
  const matching = await cache.match(request);
  if (!matching || matching.status === 404) {
    return cache.match('offline.html');
  } else {
    return matching;
  }
};

self.addEventListener('fetch', function (event) {
  event.respondWith(
    checkResponse(event.request).catch(function () {
      return returnFromCache(event.request);
    })
  );
  if (!event.request.url.startsWith('http')) {
    event.waitUntil(addToCache(event.request));
  }
});
