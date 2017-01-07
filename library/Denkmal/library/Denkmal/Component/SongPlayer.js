/**
 * @class Denkmal_Component_SongPlayer
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_SongPlayer = Denkmal_Component_Abstract.extend({

  /** @type {String} */
  _class: 'Denkmal_Component_SongPlayer',

  /** @type {Audio|Null} */
  _audio: null,

  /** @type {Object|Null} */
  _song: null,

  /**
   * @param {Object} song
   */
  playSong: function(song) {
    this.stopSong();
    if (!this._song || this._song.id != song.id) {
      this._song = song;
      this._audio = new cm.lib.Media.Audio();
      this._audio.setSource(cm.getUrlUserContent(this._song.path));
    }
    this._audio.play();
    cm.event.trigger('song:play', song);
  },

  stopSong: function() {
    if (!this._audio) {
      return;
    }
    this._audio.stop();
    cm.event.trigger('song:pause');
  },

  /**
   * @returns {Boolean}
   */
  isPlaying: function() {
    return this._audio && this._audio.isPlaying();
  },

  /**
   * @returns {Object|Null}
   */
  getCurrentlyPlayingSong: function() {
    if (!this.isPlaying()) {
      return null;
    }
    return this._song;
  }
});
