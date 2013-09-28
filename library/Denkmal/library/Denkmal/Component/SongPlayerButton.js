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
		'click .playSong': 'playSong',
		'click .pauseSong': 'pauseSong'
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
			this.$('.playSong').show();
			this.$('.pauseSong').hide();
			this._playing = false;
		}
	},

	onPlay: function(song) {
		if (song.id == this.song.id) {
			this.$('.playSong').hide();
			this.$('.pauseSong').show();
			this._playing = true;
		} else {
			this.onPause();
		}
	}
});
