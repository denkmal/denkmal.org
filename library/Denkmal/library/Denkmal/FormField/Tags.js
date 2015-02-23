/**
 * @class Denkmal_FormField_Tags
 * @extends CM_FormField_Abstract
 */
var Denkmal_FormField_Tags = CM_FormField_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_FormField_Tags',

  /** @type Array */
  tagIdList: null,

  /** @type Boolean */
  _textState: null,

  events: {
    'click .toggleText': function() {
      this.toggleText(!this._textState);
    },
    'click .toggleTag': function(event) {
      var id = $(event.currentTarget).closest('.tag').data('id');
      this.toggleTag(id);
    }
  },

  ready: function() {
    this._textState = false;
    this._populateInput();

    var self = this;
    this.getForm().$el.on('reset', function() {
      self.toggleText(false);
      _.each(self.tagIdList, function(tagId) {
        self.toggleTag(tagId, false);
      });
    });
  },

  /**
   * @param {Boolean} state
   */
  toggleText: function(state) {
    this.$('.tag.toggleText').toggleClass('active', state);
    this.trigger('toggleText', state);
    this._textState = state;
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
