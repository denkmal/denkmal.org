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
      /**
       * Same-origin workaround
       * @todo replace with https://github.com/cargomedia/CM/pull/1715
       */
      path = path.replace(cm.getUrlResource(), cm.getUrl());

      navigator.serviceWorker.register(path).then(function(registration) {
        cm.debug.log('ServiceWorker registration succeeded.');
      }).catch(function(error) {
        cm.debug.log('ServiceWorker registration failed.', error);
      });
    } else {
      cm.debug.log('ServiceWorker not supported.');
    }
  }

});
