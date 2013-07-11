<?php
return array(
	'mw.Dash' => array( 
		'scripts' => 'resources/mw.Dash.js',
		'kalturaPluginName' => 'dash'
	),
	'dashjs' => array(
		'scripts' => 'dash.js/dash.min.js',
		'dependencies' =>  array(
			'dijon',
			'q',
			'xml2json',
			'objectiron'
		)
	),
	'dijon' => array(
		'scripts' => 'dash.js/dijon.js'
	),
	'q' => array(
		'scripts' => 'dash.js/q.min.js'
	),
	'xml2json' => array(
		'scripts' => 'dash.js/xml2json.js'
	),
	'objectiron' => array(
		'scripts' => 'dash.js/objectiron.js'
	)
);