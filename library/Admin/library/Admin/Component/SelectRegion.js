/**
 * @class Admin_Component_SelectRegion
 * @extends Admin_Component_Abstract
 */
var Admin_Component_SelectRegion = Admin_Component_Abstract.extend({

  /** @type {String} */
  _class: 'Admin_Component_SelectRegion',

  events: {
    'change select': function(event) {
      var regionId = $(event.currentTarget).val() || null;
      this._setRegion(regionId);
    }
  },

  /**
   * @param {Number|Null} regionId
   * @private
   */
  _setRegion: function(regionId) {
    this.ajax('setRegion', {region: regionId});
  }
});
