/**
 * @class Admin_Component_Event
 * @extends Admin_Component_Abstract
 */
var Admin_Component_Event = Admin_Component_Abstract.extend({

  /** @type String */
  _class: 'Admin_Component_Event',

  events: {
    'click .selectSong': function(event) {
      var $song = $(event.currentTarget).closest('.selectSong');
      this.findChild('Admin_Form_Event').getField('song').setValue({'id': $song.data('id'), 'name': $song.data('label')});
    },
    'click .selectLink': function(event) {
      var $link = $(event.currentTarget).closest('.selectLink');
      this.selectLink($link.data('label'));
    },
    'toggleNext-open .eventDescription': function(event, data) {
      $(document).scrollTo(data['toggler']);
    }
  },

  ready: function() {
    this.$('.toggleNext .toggleNext-excluded').on('click', function(event) {
      event.stopPropagation();
    });
  },

  /**
   * @param {String} label
   * @param {String} searchPattern
   */
  selectLink: function(label) {
    var fieldDescription = this.findChild('Admin_Form_Event').getField('description');
    var text = fieldDescription.getValue();
    var search = new RegExp('([^\\w\\[]|^|$)' + this._escapeRegexp(label) + '([^\\w\\]]|^|$)', 'i');
    fieldDescription.setValue(text.replace(search, '$1[' + label + ']$2'));
    fieldDescription.trigger('change');
  },

  /**
   * @param {String} regexp
   * @returns {String}
   */
  _escapeRegexp: function(regexp) {
    return regexp.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
  }
});
