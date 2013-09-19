<?php

class OR_Albums extends OR_Model {
	
	public function __construct() {
		parent::__construct();
		$this->connect();
	}
	
	public function get_albums($artist_alias = null, $options = array()) {
		$this->activate();
		$args = array();
		
		$query = '';
		$query .= 'select al.*, ar.*, r.* from {ep4_albums} as al ';
		$query .= 'left join {ep4_artists} as ar ';
		$query .= 'on al.album_artist_id = ar.artist_id ';
		$query .= 'left join {ep4_albums_releases} as r ';
		$query .= 'on al.album_primary_release_id = r.release_id ';
		$query .= 'where ';
		if (!empty($artist_alias)) {
			$query .= 'ar.artist_alias = :artist_alias and ';
			$args[':artist_alias'] = $artist_alias;
		}
		$query .= 'al.album_is_visible = 1 ';
		$query .= 'and al.album_deleted = 0 ';
		$order_by = !empty($options['order_by']) ? $options['order_by'] : 'al.album_order';
		$query .= 'order by ' . $order_by;
		
		$rsAlbums = db_query($query, $args)->fetchAllAssoc('album_alias', PDO::FETCH_ASSOC);
		
		$this->deactivate();
		return $rsAlbums;
	}
	
	public function get_album($album_alias) {
		$this->activate();

		$query = '';
		$query .= 'select * from {ep4_albums} as al ';
		$query .= 'left join {ep4_albums_releases} as r ';
		$query .= 'on al.album_primary_release_id = r.release_id ';
		$query .= 'where al.album_alias = :album_alias ';
		$query .= 'and al.album_deleted = 0';
		
		$args = array(':album_alias' => $album_alias);
		
		$rsAlbum = db_query($query, $args)->fetchAssoc();
		$rsAlbum['releases'] = $this->get_releases($album_alias);
		
		$this->deactivate();
		return $rsAlbum;
	}
	
	public function get_releases($album_alias, $order_by = 'r.release_release_date desc') {
		$this->activate();
		
		$query = '';
		$query .= 'select r.* from {ep4_albums_releases} as r ';
		$query .= 'left join {ep4_albums} as al ';
		$query .= 'on r.release_album_id = al.album_id ';
		$query .= 'where al.album_alias = :album_alias ';
		$query .= 'and r.release_deleted = 0 ';
		$query .= 'order by :order_by';
		
		$args = array(':album_alias' => $album_alias, ':order_by' => $order_by);
		
		$rsReleases = db_query($query, $args)->fetchAllAssoc('release_alias', PDO::FETCH_ASSOC);
		
		$this->deactivate();
		return $rsReleases;
	}
	
	public function get_release($release_alias) {
		$this->activate();
		
		$query = '';
		$query .= 'select al.* from {ep4_albums_releases} as r ';
		$query .= 'left join {ep4_albums} as al ';
		$query .= 'on r.release_album_id = al.album_id ';
		$query .= 'where r.release_alias = :release_alias ';
		$query .= 'and al.album_deleted = 0';
		
		$args = array(':release_alias' => $release_alias);
		
		$rsAlbum = db_query($query, $args)->fetchAssoc();
		
		$query = '';
		$query .= 'select r.* from {ep4_albums_releases} as r ';
		$query .= 'left join {ep4_albums} as al ';
		$query .= 'on r.release_album_id = al.album_id ';
		$query .= 'where r.release_alias = :release_alias ';
		$query .= 'and r.release_deleted = 0';
		
		$rsRelease = db_query($query, $args)->fetchAssoc();
		
		$query = '';
		$query .= 'select e.* from {ep4_ecommerce} as e ';
		$query .= 'left join {ep4_albums_releases} as r ';
		$query .= 'on r.release_id = e.ecommerce_release_id ';
		$query .= 'where r.release_alias = :release_alias ';
		$query .= 'and e.ecommerce_deleted = 0 ';
		$query .= 'order by e.ecommerce_list_order';
		
		$rsEcommerce = db_query($query, $args)->fetchAllAssoc('ecommerce_label');
		
		$rsRelease['release_ecommerce'] = $rsEcommerce;
		$rsAlbum['releases'] = array($release_alias => $rsRelease);
		
		$this->deactivate();
		return $rsAlbum;
	}
	
	public function get_album_block_content($node) {
		$content = array();
		
		if (!empty($node->type)) {
			$node_view = node_view($node);
			
			if (isset($node_view['field_album_alias']) && !empty($node_view['field_album_alias'])) {
				$album_alias = $node_view['field_album_alias']['#items'][0]['value'];
			}
			if (isset($node_view['field_release_alias']) && !empty($node_view['field_release_alias'])) {
				$release_alias = $node_view['field_release_alias']['#items'][0]['value'];
			}
			if (isset($node_view['field_artist_alias']) && !empty($node_view['field_artist_alias'])) {
				$artist_alias = $node_view['field_artist_alias']['#items'][0]['value'];
			}
			
			if (!empty($node->field_release_alias)) {
				$content = array($this->get_release($release_alias));
			} elseif (!empty($album_alias)) {
				//$content = array($this->get_album($album_alias));
			} elseif (!empty($artist_alias)) {
				//$content = $this->get_albums($artist_alias);
			}
		}
		
		return $content;
	}
	
	public function get_album_node_content($node) {
		$content = array();
		
		if (!empty($node->field_album_alias)) {
			$album_alias = $node->field_album_alias[$node->language][0]['value'];
			$content = array($this->get_album($album_alias));
		} elseif (!empty($node->field_release_alias)) {
			$release_alias = $node->field_release_alias[$node->language][0]['value'];
			$content = array($this->get_release($release_alias));
		} elseif (!empty($node->field_artist_alias)) {
			$artist_alias = $node->field_artist_alias[$node->language][0]['value'];
			$content = $this->get_albums($artist_alias);
		}

		return $content;
	}
	
	public function get_release_block_content($node) {
		$content = array();
		
		if (!empty($node->type)) {
			$node_view = node_view($node);
			
			$release_alias = $node_view['field_release_alias']['#items'][0]['value'];
			
			if (!empty($release_alias)) {
				$content = array($this->get_release($release_alias));
			}
		}
		
		return $content;
	}
	
	public function get_release_node_content($node) {
		$content = array();
		
		if (!empty($node->field_release_alias)) {
			$release_alias = $node->field_release_alias[$node->language][0]['value'];
			$content = array($this->get_release($release_alias));
		}

		return $content;
	}
	
	public function __destruct() {
		$this->deactivate();
	}
}