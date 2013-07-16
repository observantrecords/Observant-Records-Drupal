<?php

/**
 *
 * @file
 * Connect to Observant Records database and return an autocomplete widget populated
 * by Observant Records artists.
 *
 */
class OR_Artist extends OR_Model {

	public function __construct() {
		parent::__construct();
		$this->connect();
	}

	public function get_artists() {
		$this->activate();
		$rsArtists = db_select('ep4_artists', 'a')->fields('a')->condition('artist_deleted', 0)->execute()->fetchAllAssoc('artist_alias', PDO::FETCH_ASSOC);
		$this->deactivate();
		return $rsArtists;
	}

	public function get_artist($alias) {
		$this->activate();
		$rsArtist = db_select('ep4_artists', 'a')->fields('a')->condition('artist_alias', $alias)->condition('artist_deleted', 0)->execute()->fetchAssoc();
		$this->deactivate();
		return $rsArtist;
	}

	public function get_artist_block_content($node) {
		$content = array();

		/*
		 * 
		if (!empty($node->type)) {
			$node_view = node_view($node);
			$artist_alias = $node_view['field_artist_alias']['#items'][0]['safe_value'];
			if (!empty($artist_alias)) {
				$content = array($this->get_artist($artist_alias));
			} else {
				$content = $this->get_artists();
			}
		}
		 */

		return $content;
	}

	public function get_artist_node_content($node) {
		$content = array();

		if (!empty($node->field_artist_alias)) {
			$artist_alias = $node->field_artist_alias[$node->language][0]['value'];
			$content = array($this->get_artist($artist_alias));
		} else {
			$content = $this->get_artists();
		}

		return $content;
	}

	public function __destruct() {
		$this->deactivate();
	}
}