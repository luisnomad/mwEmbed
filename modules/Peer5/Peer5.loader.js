( function( mw, $ ) { "use strict";
	var ua = navigator.userAgent;
	if( /chrome/i.test(ua)) {
		var uaArray = ua.split(' ');
		// only add plugin if we pass ua checks chrome browser version: 
		if( parseInt( uaArray[uaArray.length - 2].substr(7).split('.')[0] ) > 25 ){
			mw.addKalturaPlugin( ['mw.Peer5'], 'peer5', function( embedPlayer, callback){
				embedPlayer.peer5 = new mw.Peer5( embedPlayer, callback );
				callback();
			});
		}
	} else {
		// Peer5 not loaded, incompatible user agent
	}
})( window.mw, jQuery );
