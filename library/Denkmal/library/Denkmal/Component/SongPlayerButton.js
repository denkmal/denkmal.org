/**
 * @class Denkmal_Component_SongPlayerButton
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_SongPlayerButton = Denkmal_Component_Abstract.extend({

  /** @type String */
  _class: 'Denkmal_Component_SongPlayerButton',

  /** @type {Object} */
  song: null,

  /** @type {Boolean} */
  autoPlay: null,

  /** @type {Boolean} */
  _playing: false,

  events: {
    'click .playSong': function() {
      this.playSong();
      return false;
    },
    'click .pauseSong': function() {
      this.pauseSong();
      return false;
    }
  },

  appEvents: {
    'song:play': function(song) {
      this._onPlay(song);
    },
    'song:stop': function() {
      this._onStop();
    }
  },

  ready: function() {
    var playingSong = this._getPlayer().getCurrentlyPlayingSong();
    if (playingSong && playingSong.id == this.song.id) {
      this._onPlay(playingSong);
    }
    if (this.autoPlay) {
      this.playSong();
    }
  },

  playSong: function() {
    this._getPlayer().playSong(this.song);
  },

  pauseSong: function() {
    this._getPlayer().stopSong();
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
  },

  /**
   * @param {Object} song
   * @private
   */
  _onPlay: function(song) {
    if (song.id == this.song.id) {
      this._showPauseIcon(true);
      this._playing = true;
    } else {
      this._onStop();
    }
  },

  /**
   * @private
   */
  _onStop: function() {
    if (this._playing) {
      this._showPauseIcon(false);
      this._playing = false;
    }
  },

  /**
   * @param {Boolean} state
   * @private
   */
  _showPauseIcon: function(state) {
    this.$('.playSong').toggleClass('disabled', state);
    this.$('.pauseSong').toggleClass('disabled', !state);
  }
});
