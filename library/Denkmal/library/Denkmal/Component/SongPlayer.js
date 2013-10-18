/**
 * @class Denkmal_Component_SongPlayer
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_SongPlayer = Denkmal_Component_Abstract.extend({

	/** @type String */
	_class: 'Denkmal_Component_SongPlayer',

	/** @type MediaElement */
	_player: null,

	/** @type {Object|Null} */
	_song: null,

	ready: function() {
		var self = this;
		this._player = new MediaElement(this.$('audio').get(0), {
			type: 'audio/mp3',
			success: function(mediaElement, domObject) {
				mediaElement.addEventListener('ended', function() {
					self.pauseSong();
				});
			}
		});
	},

	/**
	 * @param {Object} song
	 */
	playSong: function(song) {
		this._song = song;
		var url = cm.getUrlUserContent(this._song.path);
		this._player.setSrc(url);
		this._player.play();
		_.invoke(cm.getViewList('Denkmal_Component_SongPlayerButton'), 'onPlay', this._song);
	},

	pauseSong: function() {
		this._song = null;
		this._player.pause();
		_.invoke(cm.getViewList('Denkmal_Component_SongPlayerButton'), 'onPause');
	},

	/**
	 * @returns {Object}
	 */
	getSong: function() {
		return this._song;
	}
});
