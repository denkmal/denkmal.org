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
      var path = cm.getUrlResource('layout', 'js/service-worker.js', {sameOrigin: true, root: true});

      navigator.serviceWorker.register(path, {scope: '/'}).then(function(registration) {
        cm.debug.log('ServiceWorker registration succeeded.');
      }).catch(function(error) {
        cm.debug.log('ServiceWorker registration failed.', error);
      });
    } else {
      cm.debug.log('ServiceWorker not supported.');
    }
  }

});
