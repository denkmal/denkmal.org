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
	_playing: false,

	/** @type {Object} */
	_player: null,

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

	ready: function() {
		this._player = cm.findView('Denkmal_Component_SongPlayer');
		var playerSong = this._player.getSong();
		if (playerSong && playerSong.id == this.song.id) {
			this.onPlay(this.song);
		}
	},

	playSong: function() {
		this._player.playSong(this.song);
	},

	pauseSong: function() {
		this._player.pause();
	},

	onPause: function() {
		if (this._playing) {
			this.showPauseIcon(false);
			this._playing = false;
		}
	},

	/**
	 * @param {Object} song
	 */
	onPlay: function(song) {
		if (song.id == this.song.id) {
			this.showPauseIcon(true);
			this._playing = true;
		} else {
			this.onPause();
		}
	},

	/**
	 *
	 * @param {Boolean} state
	 */
	showPauseIcon: function(state) {
		$('.playSong').toggleClass('disabled', state);
		$('.pauseSong').toggleClass('disabled', !state);
	}
});
