self.addEventListener('install', function(event) {
  // Automatically take over the previous worker.
  event.waitUntil(self.skipWaiting());
});

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

/**
 * @param {String} method
 * @param {Object} params
 * @returns {Promise}
 */
function sendRpc(method, params) {
  var rpcData = JSON.stringify({method: method, params: params});
  return fetch('/rpc/null', {method: 'POST', body: rpcData}).then(function(response) {
    return response.json().then(function(result) {
      if (result['error']) {
        throw new Error('RPC call failed: ' + result['error']);
      }
      return result['success']['result'];
    });
  });
}

/**
 * @param {String} url
 * @returns {Promise}
 */
function openWindow(url) {
  return clients.matchAll({type: 'window'}).then(function(clientList) {
    for (var i = 0; i < clientList.length; i++) {
      var client = clientList[i];
      if (client.url == url && 'focus' in client) {
        return client.focus();
      }
    }
    if (clients.openWindow) {
      return clients.openWindow(url);
    }
  });
}
