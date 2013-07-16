<?php

class OR_Audio extends OR_Model {

	public function __construct() {
		parent::__construct();
		$this->connect();
	}

	public function get_audio($audio_id) {
		$this->activate();

		$query = '';
		$query .= 'select au.* ';
		$query .= 'from {ep4_audio} as au ';
		$query .= 'where au.audio_id = :audio_id ';
		$query .= 'and au.audio_deleted = 0';

		$args = array(':audio_id' => $audio_id);

		$rsAudio = db_query($query, $args)->fetchAssoc();

		$this->deactivate();

		return $rsAudio;
	}

	public function __destruct() {
		$this->deactivate();
	}

}