/**
 * @class Denkmal_FormField_Tags
 * @extends CM_FormField_Abstract
 */
var Denkmal_FormField_Tags = CM_FormField_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_FormField_Tags',

  /** @type Array */
  tagIdList: null,

  /** @type Array */
  _specialStateList: null,

  events: {
    'click .toggleSpecial': function(event) {
      var type = $(event.currentTarget).closest('.tag').data('type');
      this.toggleSpecial(type, !this._specialStateList[type]);
    },
    'click .toggleTag': function(event) {
      var id = $(event.currentTarget).closest('.tag').data('id');
      this.toggleTag(id);
    }
  },

  ready: function() {
    this._specialStateList = {};
    this._populateInput();

    var self = this;
    this.getForm().$el.on('reset', function() {
      _.each(self._specialStateList, function(state, type) {
        self.toggleSpecial(type, false);
      });
      _.each(self.tagIdList, function(tagId) {
        self.toggleTag(tagId, false);
      });
    });
  },

  /**
   * @param {String} type
   * @param {Boolean} state
   */
  toggleSpecial: function(type, state) {
    this.$('.tag.tag-special[data-type="' + type + '"]').toggleClass('active', state);
    this.trigger('toggleSpecial.' + type, state);
    this._specialStateList[type] = state;
  },

  /**
   * @param {Number} id
   * @param {Boolean} [state]
   */
  toggleTag: function(id, state) {
    if (typeof state === 'undefined') {
      state = !_.contains(this.tagIdList, id);
    }
    this.tagIdList = state ? _.union(this.tagIdList, [id]) : _.without(this.tagIdList, id);
    if (state && this._hasCardinality() && this._getCardinalityLeft() < 0) {
      this.toggleTag(this.tagIdList[0], false);
    }
    this.$('.tag[data-id="' + id + '"]').toggleClass('active', state);
    this._populateInput();

    if (this._hasCardinality()) {
      this.$('.cardinality-left').text(this._getCardinalityLeft());
    }
  },

  _populateInput: function() {
    this.getInput().val(JSON.stringify(this.tagIdList));
  },

  /**
   * @returns {Boolean}
   */
  _hasCardinality: function() {
    return null !== this.getOption('cardinality');
  },

  /**
   * @returns {Number}
   */
  _getCardinality: function() {
    if (!this._hasCardinality()) {
      cm.error.triggerThrow('Cardinality not set');
    }
    return this.getOption('cardinality');
  },

  /**
   * @returns {Number}
   */
  _getCardinalityLeft: function() {
    return this._getCardinality() - this.tagIdList.length;
  }
});
