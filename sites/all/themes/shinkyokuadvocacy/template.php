<?php

function shinkyokuadvocacy_preprocess_node(&$vars) {
	$vars['submitted'] = '&#8212; Posted by <strong>' . $vars['node']->name . '</strong> on ' . date('F d, Y H:i', $vars['node']->created);
}

function shinkyokuadvocacy_get_vigilante_uri($key = 'to_vigilante') {
	global $config_url_base;
	return $config_url_base[$key];
}