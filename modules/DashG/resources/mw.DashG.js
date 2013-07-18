(function ( mw, $ ) {
	"use strict";

	mw.Dash = function(embedPlayer, callback ) {
		return this.init( embedPlayer, callback );
	};

	mw.Dash.prototype = {
		pluginName : 'dash',

		init: function( embedPlayer, callback ){
			if( ! this.isEnvironmentSuported() ){
				callback();
				return ;
			}
		},
		isEnvironmentSuported: function(){
			return ( !! window.MediaSource );
		},
		bindPlayer: function(){
			var _this = this;
			// Build the dash player at player ready time ~for now~
			// TODO tie into early source selection add support for the player type
			// and probably extend mw.EmbedPlayerNative to override embed calls.  
			this.embedPlayer.bindHelper( 'playerReady', function(){
				_this.initDashPlayer();
				
				// update interface ( disable flavor selector for now )
				_this.embedPlayer.getInterface().find('.ui-widget.source-switch').text('Dash');
				_this.embedPlayer.getInterface().find('.ui-widget.source-switch').unbind('click');
			});
			// TODO check sources for dash type
			return ;
		},
		initDashPlayer: function(){
			var dashUrl = null;
			var vid =  this.embedPlayer.getPlayerElement();
			// Check for force source 
			if( this.getConfig( 'forceSourceUrl' ) ) {
				dashUrl = this.getConfig( 'forceSourceUrl' );
			}

		},
		// Should be part of base class. 
		getConfig: function( attr ) {
			// return the attribute value
			return this.embedPlayer.getKalturaConfig( this.pluginName, attr);
		}
	}

})
(window.mw, window.jQuery);
