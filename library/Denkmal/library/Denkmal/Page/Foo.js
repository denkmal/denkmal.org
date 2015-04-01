/**
 * @class Denkmal_Page_Foo
 * @extends Denkmal_Page_Abstract
 */
var Denkmal_Page_Foo = Denkmal_Page_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Page_Foo',

  ready: function(){
    var workerPath = cm.getUrlResource('layout', 'js/worker.js');

    var worker = new Worker(workerPath);

    worker.addEventListener('message', function(e) {
      console.log('Worker said: ', e.data);
    }, false);

    worker.postMessage('Hello World');
  }
});
