var sendRpc = require('worker/sendRpc');
var openWindow = require('worker/openWindow');

self.addEventListener('push', function(event) {
  event.waitUntil(self.registration.pushManager.getSubscription().then(function(subscription) {
    if (!subscription) {
      return;
    }
    return sendRpc('Denkmal_Push_Notification_Message.getListBySubscription', {
      endpoint: subscription.endpoint
    }).then(function(messageList) {
      var promises = [];
      for (var i = 0; i < messageList.length; i++) {
        var message = messageList[i];
        promises.push(self.registration.showNotification(message['title'], {
          body: message['body'],
          icon: message['icon'],
          badge: message['badge'],
          tag: message['tag'],
          data: message['data']
        }));
      }
      return Promise.all(promises);
    });
  }));
});

self.addEventListener('notificationclick', function(event) {
  var data = event.notification.data;
  event.notification.close();
  event.waitUntil(openWindow(data['url']));
});
