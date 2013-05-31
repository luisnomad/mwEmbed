<?php 
// initi directly: 
if( !isset($_GET['base']) ){
	die( 'Error missing base m3u8 url');
}
// TODO seperate init from class 
$myM3u8Wrapper = new m3u8Wrapper ( $_GET['base'] );
$m3u8Wrapper->output();

class m3u8Wrapper {
	// By default pass along all cookies: 
	var $passCokkies = true;
	
	function __construct( $baseUrl ){
		$this->baseUrl = $baseUrl ;
		$this->parseRequestedFeatures();
		$this->parseBaseRequest();
	}
	function parseRequestedFeatures(){
		// TODO should parse enabled features ( like i
	}
	function parseBaseRequest(){
		// does the actual curl for m3u8 content, parse m3u8 for relevent components. 
		$status = $this->doRequest();
		print_r( $status );
	}
	function doRequest(){
		$url = urldecode( $this->baseUrl );
		if ( !$url ) {
			// Passed url not specified.
			$contents = 'ERROR: url not specified';
			$status = array( 'http_code' => 'ERROR' );
			return $status;
		}
		
		if ( !preg_match( $valid_url_regex, $url ) ) {
			// Passed url doesn't match $valid_url_regex.
			$contents = 'ERROR: invalid url';
			$status = array( 'http_code' => 'ERROR' );
			return $status;
		}
		// setup the curl obj:
		$ch = curl_init( $url );
		// Always follow redirects: 
		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		// Add a total curl execute timeout of 10 seconds: 
		curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
		
		// pass along any cookies:
		if( $this->$passCokkies ){
			$cookie = array();
			foreach ( $_COOKIE as $key => $value ) {
				$cookie[] = $key . '=' . $value;
			}
			// Always start a session ( so we can pass along cookies ) 
			session_start();
			$cookie[] = SID;
			$cookie = implode( '; ', $cookie );
			curl_setopt( $ch, CURLOPT_COOKIE, $cookie );
		}
		
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_HEADER, true );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		
		// Forward the client ip for GeoLookup:
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'X-Forwarded-For: ' . $_SERVER['REMOTE_ADDR']
		));
		
		
		// Forward the user agent:
		curl_setopt( $ch, CURLOPT_USERAGENT, isset( $_GET['user_agent'] ) ? $_GET['user_agent'] : $_SERVER['HTTP_USER_AGENT'] );
		$parts = preg_split( '/([\r\n][\r\n])\\1/', curl_exec( $ch ), 2 );
		if( count($parts) != 2 ){
			$status = array( 'http_code' => 'ERROR' );
			$header ='';
			$contents = curl_error( $ch );
		} else {
			if ( preg_match( '/302 Moved Temporarily/', $parts[0] ) ) {
				$parts = preg_split( '/([\r\n][\r\n])\\1/', $parts[1], 2 );
			}
			list( $header, $contents ) = $parts;
		}
		$status = curl_getinfo( $ch );
		curl_close( $ch );
		// check for empty contents: 
		if( trim( $contents ) == '' ){
			$status = array( 'http_code' => 'ERROR' );
			$contents = 'ERROR: empty response';
		}
		return $satus;
	}
	function output(){
		
	}
}