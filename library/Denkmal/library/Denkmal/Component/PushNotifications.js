/**
 * @class Denkmal_Component_PushNotifications
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_PushNotifications = Denkmal_Component_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Component_PushNotifications',

  ready: function() {
    if (this._checkSupport()) {
      this._enableSubscription();
      this._checkState();
    }
  },

  /**
   * @return {Boolean}
   */
  _checkSupport: function() {
    if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
      cm.debug.log('Notifications not supported.');
      return false;
    }
    if (Notification.permission === 'denied') {
      cm.debug.log('Notifications denied by the user.');
      return false;
    }
    if (!('PushManager' in window)) {
      cm.debug.log('Push messaging not supported.');
      return false;
    }
    return true;
  },

  _checkState: function() {
    navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {
      serviceWorkerRegistration.pushManager.getSubscription()
        .then(function(subscription) {
          cm.debug.log('hello', subscription);

          if (!subscription) {
            // We aren't subscribed to push, so set UI
            // to allow the user to enable push
            return;
          }

          // Keep your server in sync with the latest subscriptionId
          cm.debug.log('Successful subscription: ', subscription);
        })
        .catch(function(err) {
          cm.debug.log('Error during getSubscription()', err);
        });
    });
  },

  _enableSubscription: function() {
    navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {
      cm.debug.log('subscribe');
      serviceWorkerRegistration.pushManager.subscribe()
        .then(function(subscription) {
          cm.debug.log('The subscription was successful:', subscription);

          // TODO: Send the subscription.subscriptionId to the server
        })
        .catch(function(e) {
          if (Notification.permission === 'denied') {
            cm.debug.log('Permission for Notifications was denied');
          } else {
            cm.debug.log('Unable to subscribe to push.', e);
          }
        });
    });
  }
});
