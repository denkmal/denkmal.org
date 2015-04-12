/**
 * @class Denkmal_Component_PushNotifications
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_PushNotifications = Denkmal_Component_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Component_PushNotifications',

  events: {
    'change .toggleNotifications': function(event) {
      var state = event.currentTarget.checked;
      this.togglePush(state);
    }
  },

  ready: function() {
    if (this._checkSupport()) {
      this.$el.addClass('state-enabled');

      if ('granted' === Notification.permission) {
        this._getPushSubscription().then(function(subscription) {
          cm.debug.log('The subscription is:', subscription ? 'present': 'disabled');
          // TODO: Send the subscriptionId, endpoint to the server
        }).catch(function(e) {
          cm.debug.log('Unable to retrieve push.', e);
        });
      }

      this._updatePermissionUI();
    }
  },

  /**
   * @param {Boolean} state
   * @returns {Promise}
   */
  togglePush: function(state) {
    if (state) {
      return this._subscribePush();
    } else {
      return this._unsubscribePush();
    }
  },

  /**
   * @param {Boolean} [hasSubscription]
   */
  _updatePermissionUI: function(hasSubscription) {
    this.$('.toggleNotifications')
      .prop('disabled', ('denied' === Notification.permission))
      .prop('checked', hasSubscription);
  },

  /**
   * @return {Boolean}
   */
  _checkSupport: function() {
    if (!('serviceWorker' in navigator)) {
      cm.debug.log('ServiceWorker not supported.');
      return false;
    }
    if (!('showNotification' in ServiceWorkerRegistration.prototype)) {
      cm.debug.log('Notifications not supported.');
      return false;
    }
    if (!('PushManager' in window)) {
      cm.debug.log('Push messaging not supported.');
      return false;
    }
    return true;
  },

  /**
   * @returns {Promise}
   */
  _subscribePush: function() {
    return navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {
      return serviceWorkerRegistration.pushManager.subscribe().then(function(subscription) {
        cm.debug.log('Push subscribed:', subscription);
        // TODO: Send the subscriptionId, endpoint to the server
      });
    });
  },

  /**
   * @returns {Promise}
   */
  _unsubscribePush: function() {
    return this._getPushSubscription().then(function(subscription) {
      if (!subscription) {
        return;
      }

      return subscription.unsubscribe().then(function() {
        cm.debug.log('Push unsubscribed:', subscription);
        // TODO: Send the subscriptionId, endpoint to the server
      }).catch(function(e) {
        cm.debug.log('Unable to unsubscribe to push.', e);
      });
    });
  },

  /**
   * @returns {Promise}
   */
  _getPushSubscription: function() {
    var self = this;
    return navigator.serviceWorker.ready.then(function(serviceWorkerRegistration) {
      return serviceWorkerRegistration.pushManager.getSubscription()
        .then(function(subscription) {
          self._updatePermissionUI(!!subscription);
          return subscription;
        });
    });
  }
});
