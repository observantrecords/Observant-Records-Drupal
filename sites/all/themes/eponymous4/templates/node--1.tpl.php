<?php

global $user;

echo '<pre>';

$mt_export = '/home/nemesisv/websites/dev/vigilantmedia.com/drupal/sites/eponymous4.com/files/eponymous_4_official_site.txt';

if (false !== ($fp = fopen($mt_export, 'r'))) {
	$mt_input = fread($fp, filesize($mt_export));
	fclose($fp);
}


$entries = explode('--------', $mt_input);
$mt_entries = array();
foreach ($entries as $entry) {
	$components = explode('-----', $entry);
	$mt_entry = array();
	foreach ($components as $i => $component) {
		if ($i == 0) {
			$entry_meta = explode("\n", $component);
			foreach ($entry_meta as $meta) {
				$entry_body = explode(': ', $meta, 2);
				if (!empty($entry_body[1])) {
					$mt_entry[strtolower($entry_body[0])] = $entry_body[1];
				}
			}
		} else {
			$entry_body = explode(':' . "\n", $component, 2);
			if (!empty($entry_body[1])) {
				$mt_entry[trim(strtolower($entry_body[0]))] = $entry_body[1];
			}
		}
	}
	if (!empty($mt_entry)) {
		$mt_entries[] = $mt_entry;
	}
}

foreach ($mt_entries as $node_entry) {
	$retrieved_node = db_query('select * from node where title = :mytitle', array(':mytitle' => $node_entry['title']))->fetchAssoc();
	//print_r($retrieved_node);
	$node = (object) array();
	$node_type_default = variable_get('node_options_article', array('status', 'promote'));
	$node->nid = $retrieved_node['nid'];
	$node->status = 1;
	$node->promote = in_array('promote', $node_type_default);
	$node->revision = in_array('revision', $node_type_default);
	$node->uid = 1;
	$node->name = 'eponymous4';
	$node->language = 'und';
	$node->date = $node_entry['date'];
	$node->updated = $node_entry['date'];
	$node->title = $node_entry['title'];
	$node->body['und'][0]['value'] = $node_entry['body'] . "\n" . $node_entry['extended body'];
	$node->body['und'][0]['format'] = 'full_html';
	switch ($node_entry['category']) {
		case 'Work Release Program: Albums':
			$node->type = 'album';
			$node->field_tags['und'][0] = (array) taxonomy_term_load(2);
			$node->path = array('alias' => 'music/' . $node_entry['basename']);
			break;
		case 'Work Release Program: Songs':
			$node->type = 'track';
			$node->path = array('alias' => 'music/track/' . $node_entry['basename']);
			$node->field_tags['und'][0] = (array) taxonomy_term_load(2);
			break;
		default:
			$node->type = 'article';
			$node->path = array('alias' => 'blog/' .$node_entry['basename']);
			$node->field_tags['und'][0] = (array) taxonomy_term_load(1);
	}
	//print_r($node);
	$new_node = node_submit($node);
	print_r($new_node);
	node_save($node);
	
	/*
	 * 
	$node = (object) array();
	$node_type_default = variable_get('node_options_article', array('status', 'promote'));
	$node->status = 1;
	$node->promote = in_array('promote', $node_type_default);
	$node->revision = in_array('revision', $node_type_default);
	$node->uid = 1;
	$node->name = 'eponymous4';
	$node->language = 'und';
	$node->date = $node_entry['date'];
	$node->updated = $node_entry['date'];
	$node->path = array('alias' => $node_entry['basename']);
	$node->title = $node_entry['title'];
	$node->body['und'][0]['value'] = $node_entry['body'] . "\n" . $node_entry['extended body'];
	$node->body['und'][0]['format'] = 'full_html';
	switch ($node_entry['category']) {
		case 'Work Release Program: Albums':
			$node->type = 'album';
			$node->field_tags['und'][0] = (array) taxonomy_term_load(2);
			break;
		case 'Work Release Program: Songs':
			$node->type = 'track';
			$node->field_tags['und'][0] = (array) taxonomy_term_load(2);
			break;
		default:
			$node->type = 'article';
			$node->field_tags['und'][0] = (array) taxonomy_term_load(1);
	}
	$new_node = node_submit($node);
	print_r($new_node);
	//node_save($new_node);
	 */
	//print_r($node_entry);
}

echo '</pre>';