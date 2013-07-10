(function (mw, $) {
	"use strict";

	mw.Dash = function (embedPlayer, callback) {
		return this.init(embedPlayer, callback);
	};

	mw.Dash.prototype = {
		bindPostfix:'.Dash',

		init:function (embedPlayer, callback) {
			var _this = this;
		},
		bindPlayer:function (event, embedPlayer) {
			// if not specified otherwise, use highest BR
		},
		getConfig:function (propId) {
			// return the attribute value
			return this.embedPlayer.getKalturaConfig('dash', propId);
		}
	}

})
	(window.mw, window.jQuery);
