<?php
/**
 * Peer5 plugin manifest 
*/

return array (
	'dash' => array(
		'description' => 'Support mpeg-dash transport for supporting browsers which support it',
		'attributes' => array(
			'sourceUrl' => array(
				'doc' => "The DASH manifest URL, default null, if set overrides platform sources",
				'type' => 'url'
			),
		)
	)
);