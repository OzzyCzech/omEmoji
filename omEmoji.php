<?php
/*
Plugin Name: omEmoji
Description: Emoticons from http://www.emoji-cheat-sheet.com/ for Wordpress
Version: 1.0
Author: Roman Ožana
Author URI: http://www.omdesign.cz
*/

add_action(
	'plugins_loaded', function () {
		global $wpsmiliestrans;
		$wpsmiliestrans = require_once __DIR__ . '/codes.php';
	}
);

// Filter smile URL
add_filter(
	'smilies_src', function ($img_src, $img, $siteurl) {
		return plugins_url(basename(dirname(__FILE__)) . '/emojis/' . $img);
	}, 3, 10
);


// Smile shortcode
add_shortcode(
	'smiles', function () {
		global $wpsmiliestrans;
		$s = '';
		foreach ($wpsmiliestrans as $smile => $img) {
			$url = plugins_url(basename(dirname(__FILE__)) . '/emojis/' . $img);
			$s .= sprintf(
				'<li style="float:right; width: 33%%; margin: 2px 0"><img src="%s" />&nbsp;<span>%s</span></li>', $url, $smile
			);
		}
		return '<ul style="
				margin:1em 0;
				padding:1em;
				list-style-type:none;
				background: #fff;
				border:1px solid #ddd;
				overflow:auto;
				font-size:14px;
				color:#555;
				">' . $s . '</ul>';
	}
);