/**
 * @class Denkmal_Component_SongPlayer
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_SongPlayer = Denkmal_Component_Abstract.extend({

	/** @type String */
	_class: 'Denkmal_Component_SongPlayer',

	/** @type MediaElement */
	_player: null,

	ready: function() {
		this._player = new MediaElement(this.$('audio').get(0), {
			type: 'audio/mp3'
		});
	},

	/**
	 * @param {Object} song
	 */
	playSong: function(song) {
		var url = cm.getUrlUserContent(this.song.path);
		this._player.setSrc(url);
		this._player.play();
	}
});
