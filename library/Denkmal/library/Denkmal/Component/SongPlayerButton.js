/**
 * @class Denkmal_Component_SongPlayerButton
 * @extends Denkmal_Component_Abstract
 */
var Denkmal_Component_SongPlayerButton = Denkmal_Component_Abstract.extend({

	/** @type String */
	_class: 'Denkmal_Component_SongPlayerButton',

	/**	@type {Object} */
	song: null,

	events: {
		'click .toggleSong': 'toggleSong'
	},

	toggleSong: function() {
		cm.findView('Denkmal_Component_SongPlayer').playSong(this.song);
	}
});
