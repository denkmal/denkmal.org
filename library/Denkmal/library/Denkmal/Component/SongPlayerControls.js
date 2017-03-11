/**
 * @class Denkmal_Component_SongPlayerControls
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_SongPlayerControls = Denkmal_Component_Abstract.extend({

  /** @type {String} */
  _class: 'Denkmal_Component_SongPlayerControls',

  /** @type {Boolean} */
  _playing: false,

  events: {
    'click .pause': function() {
      this.pause();
    }
  },

  appEvents: {
    'song:play': function() {
      this._setPlaying(true);

    },
    'song:stop': function() {
      this._setPlaying(false);
    }
  },

  ready: function() {
    var playing = this._getPlayer().isPlaying();
    this._setPlaying(playing);
  },

  pause: function() {
    this._getPlayer().stopSong();
  },

  /**
   * @param {Boolean} playing
   * @private
   */
  _setPlaying: function(playing) {
    this._playing = playing;
    this.$el.attr('data-is-playing', this._playing ? '' : null);
  },

  /**
   * @returns {Denkmal_Component_SongPlayer}
   * @private
   */
  _getPlayer: function() {
    var player = cm.findView('Denkmal_Component_SongPlayer');
    if (!player) {
      throw new Error('No player found');
    }
    return player;
  }
});
