<?php
/*
Plugin Name: JSON Response
Plugin URI: https://github.com/tessus/yourls-json-response
Description: Add .json (or a custom string/character) to the short URL to get info about it as a JSON response.
Version: 1.0
Author: tessus
Author URI: https://evermeet.cx
*/

// String or character to add to a short URL to trigger the JSON response
if (!defined('TESSUS_JSON_TRIGGER'))
{
	define('TESSUS_JSON_TRIGGER', '\.json');
}

// Handle failed loader request
yourls_add_action('loader_failed', 'tessus_json_response');

// Check for the trigger

function tessus_json_response($args)
{
	$pattern = yourls_make_regexp_pattern(yourls_get_shorturl_charset());

	if (preg_match("@^([$pattern]+)".TESSUS_JSON_TRIGGER."$@", $args[0], $matches))
	{
		$keyword = isset($matches[1]) ? $matches[1] : '';
		$keyword = yourls_sanitize_keyword($keyword);

		// Only do something, if shorturl exists
		if (yourls_is_shorturl($keyword))
		{
			// Generate the json response
			tessus_generate_json_response($keyword);
			die();
		}
	}
}

function tessus_generate_json_response($keyword)
{
	header('Content-Type: application/json');

	$json = array(
		'url'      => yourls_get_keyword_longurl($keyword),
		'title'    => yourls_get_keyword_title($keyword),
		'keyword'  => $keyword,
		'shorturl' => YOURLS_SITE.'/'.$keyword
	);

	echo json_encode($json, JSON_UNESCAPED_SLASHES);
}
