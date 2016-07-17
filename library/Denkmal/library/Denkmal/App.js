/**
 * @class Denkmal_App
 * @extends CM_App
 */
var Denkmal_App = CM_App.extend({

  ready: function() {
    CM_App.prototype.ready.call(this);

    this._registerServiceWorker();
  },

  _registerServiceWorker: function() {
    if ('serviceWorker' in navigator) {
      var url = cm.getUrlServiceWorker();

      navigator.serviceWorker.register(url, {scope: cm.getUrl()}).then(function(registration) {
        cm.debug.log('ServiceWorker registration succeeded.');
      }).catch(function(error) {
        cm.debug.log('ServiceWorker registration failed.', error);
      });
    } else {
      cm.debug.log('ServiceWorker not supported.');
    }
  }

});
