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

  initialize: function() {
    CM_FormField_Abstract.prototype.initialize.call(this);

    this._specialStateList = {};
  },

  ready: function() {
    _.each(_.countBy(this.tagIdList), function(count, tagId) {
      this.setTag(tagId, count);
    }, this);
    this._populateInput();

    var self = this;
    this.getForm().$el.on('reset', function() {
      _.each(self._specialStateList, function(state, type) {
        self.toggleSpecial(type, false);
      });
      _.each(self.tagIdList, function(tagId) {
        self.setTag(tagId, 0);
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
   */
  toggleTag: function(id) {
    var count = _.filter(this.tagIdList, function(el) {
      return el === id;
    }).length;
    count = (count + 1) % (this.getOption('itemCardinality') + 1);

    this.setTag(id, count);
  },

  /**
   * @param {Number} id
   * @param {Number} count
   */
  setTag: function(id, count) {
    var nTimesId = _.times(count, _.constant(id));
    this.tagIdList = _.without(this.tagIdList, id).concat(nTimesId);

    if (count > 0 && this._hasCardinality() && this._getCardinalityLeft() < 0) {
      this.setTag(this.tagIdList[0], 0);
    }
    this.$('.tag[data-id="' + id + '"] .count').text(count);
    this.$('.tag[data-id="' + id + '"]')
      .toggleClass('active', count > 0)
      .toggleClass('hasCount', count > 1);
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
