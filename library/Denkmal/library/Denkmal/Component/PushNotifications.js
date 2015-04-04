/**
 * @class Denkmal_Component_PushNotifications
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_PushNotifications = Denkmal_Component_Abstract.extend({

	/** @type String */
	_class: 'Denkmal_Component_PushNotifications',

  ready: function() {

    if (!('serviceWorker' in navigator)) {
      console.warn('ServiceWorker not supported.');
      return;
    }

    if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
      console.warn('Notifications not supported.');
      return;
    }

    if (Notification.permission === 'denied') {
      console.warn('The user has blocked notifications.');
      return;
    }

    if (!('PushManager' in window)) {
      console.warn('Push messaging not supported.');
      return;
    }

    var workerPath = cm.getUrlResource('layout', 'js/serviceworker.js');
    workerPath = workerPath.replace(cm.getUrlResource(), cm.getUrl());  // No CORS supported

    var self = this;
    navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {
      console.log('serviceWorker ready');
    }, function() {
      console.log('serviceWorker failed');
    });

    navigator.serviceWorker.register(workerPath).then(function(registration) {
      console.log('ServiceWorker registration successful with scope: ', registration.scope);
      navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {
        console.log('serviceWorker ready');
      });
      self.enableSubscription();
      self.initialiseSubscription();
    }).catch(function(err) {
      console.log('ServiceWorker registration failed: ', err);
    });
  },

  initialiseSubscription: function(serviceWorkerRegistration) {
    if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
      console.warn('Notifications not supported.');
      return;
    }

    if (Notification.permission === 'denied') {
      console.warn('The user has blocked notifications.');
      return;
    }

    if (!('PushManager' in window)) {
      console.warn('Push messaging not supported.');
      return;
    }

    navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {
      serviceWorkerRegistration.pushManager.getSubscription()
        .then(function(subscription) {
          console.log('hello', subscription);

          if (!subscription) {
            // We aren't subscribed to push, so set UI
            // to allow the user to enable push
            return;
          }

          // Keep your server in sync with the latest subscriptionId
          console.log('Successful subscription: ', subscription);
        })
        .catch(function(err) {
          console.warn('Error during getSubscription()', err);
        });
    });
  },

  enableSubscription: function() {
    navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {
      console.log('subscribe');
      serviceWorkerRegistration.pushManager.subscribe()
        .then(function(subscription) {
          console.log('The subscription was successful:', subscription);

          // TODO: Send the subscription.subscriptionId to the server
        })
        .catch(function(e) {
          if (Notification.permission === 'denied') {
            console.warn('Permission for Notifications was denied');
          } else {
            console.error('Unable to subscribe to push.', e);
          }
        });
    });
  }
});
