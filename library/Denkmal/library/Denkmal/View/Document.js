/**
 * @class Denkmal_View_Document
 * @extends CM_View_Document
 */
var Denkmal_View_Document = CM_View_Document.extend({

  /** @type String */
  _class: 'Denkmal_View_Document',

  /** @type Number */
  dayOffset: null,

  /** @type String|Null */
  timeZone: null,

  /**
   * @returns {moment.fn}
   */
  getCurrentDate: function() {
    var date = moment();
    if (this.timeZone) {
      date = date.tz(this.timeZone);
    }
    date = date.subtract(this.dayOffset, 'hours');
    date = date.set({'hour': 0, 'minute': 0, 'second': 0, 'millisecond': 0});
    return date;
  }

});
