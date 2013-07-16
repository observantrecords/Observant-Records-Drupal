<?php

function emptyensemble_preprocess_node(&$vars) {
	$vars['submitted'] = '&#8212; Posted by <strong>' . $vars['node']->name . '</strong> on ' . date('F d, Y H:i', $vars['node']->created);
}

function emptyensemble_preprocess_page(&$vars) {
	if (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) {
		$tid = arg(2);
		$vars['theme_hook_suggestions'][] = 'page__taxonomy__' . $tid;
	}
}

function emptyensemble_block_view($delta = '') {
	$node = menu_get_object();
	switch($delta) {
		case 'album_info':
			$album_info = new OR_Albums();
			$release_alias = $node->field_release_alias[$node->language][0]['value'];
			$block['subject'] = NULL;
			$block['content'] = array(
				'#albums' => $album_info->get_album_block_content($node),
				'#release_alias' => $release_alias,
				'#theme' => 'block_album_info',
			);
			break;
	}

	return $block;
}

function emptyensemble_theme() {
	$theme = array(
		'block_album_info' => array(
			'variables' => array(
				'albums' => NULL,
				'release_alias' => NULL,
			),
			'template' => 'templates/emptyensemble.block.album_info',
		),
	);
	
	return $theme;
}

function emptyensemble_get_vigilante_uri($key = 'to_vigilante') {
	global $config_url_base;
	return $config_url_base[$key];
}
