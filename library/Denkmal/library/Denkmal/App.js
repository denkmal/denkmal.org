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
      var path = cm.getUrlResource('layout', 'js/service-worker.js');
      path = path.replace(cm.getUrlResource(), cm.getUrl());  // No CORS supported

      navigator.serviceWorker.register(path).then(function(registration) {
        cm.debug.log('ServiceWorker registration succeeded.');
      }).catch(function(err) {
        cm.debug.log('ServiceWorker registration failed.');
      });
    } else {
      cm.debug.log('ServiceWorker not supported.');
    }
  }

});
