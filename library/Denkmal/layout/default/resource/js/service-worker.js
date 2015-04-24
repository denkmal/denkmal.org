self.addEventListener('install', function(event) {
  // Automatically take over the previous worker.
  event.waitUntil(self.skipWaiting());
});

self.addEventListener('push', function(event) {
  console.debug('Service worker: push', event);

  event.waitUntil(self.registration.pushManager.getSubscription().then(function(subscription) {
    if (!subscription) {
      return;
    }
    return sendRpc('Denkmal_Push_Notification_Message.getListBySubscription', {
      subscriptionId: subscription.subscriptionId,
      endpoint: subscription.endpoint
    }).then(function(dataList) {
      var promises = [];
      for (var i = 0; i < dataList.length; i++) {
        var data = dataList[i];
        promises.push(self.registration.showNotification(data['title'], {
          body: data['body'],
          icon: data['icon'],
          tag: data['tag']
        }));
      }
      return Promise.all(promises);
    });
  }));
});

self.addEventListener('notificationclick', function(event) {
  event.notification.close();
  event.waitUntil(openWindow('/now'));
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
 * @param {String} path
 * @returns {Promise}
 */
function openWindow(path) {
  return clients.matchAll({type: 'window'}).then(function(clientList) {
    for (var i = 0; i < clientList.length; i++) {
      var client = clientList[i];
      var url = new URL(client.url);
      if (url.pathname === path && 'focus' in client) {
        return client.focus();
      }
    }
    if (clients.openWindow) {
      return clients.openWindow(path);
    }
  });
}
