self.addEventListener('install', function(event) {
  console.debug('Service worker: install');
});

self.addEventListener('activate', function(event) {
  console.debug('Service worker: activate');
});

self.addEventListener('fetch', function(event) {
  console.debug('Service worker: fetch', event);
});

self.addEventListener('push', function(event) {
  console.debug('Service worker: push', event);

  var title = 'Yay a message.';
  var body = 'We have received a push message.';
  var icon = '/images/icon-192x192.png';
  var tag = 'simple-push-demo-notification-tag';

  event.waitUntil(
    self.registration.showNotification(title, {
      body: body,
      icon: icon,
      tag: tag
    })
  );
});
