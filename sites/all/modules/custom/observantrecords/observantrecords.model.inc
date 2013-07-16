<?php

/**
 * @file
 * A library to connect to the Observant Records database.
 *
 */

class OR_Model {

	private $database_name;
	private $username;
	private $password;
	private $host;
	private $driver;

	public function __construct() {
		require_once('observantrecords.config.inc');

		$this->database_name = OR_DB_NAME;
		$this->username = OR_DB_USER;
		$this->password = OR_DB_PASSWORD;
		$this->host =  OR_DB_HOST;
		$this->driver = 'mysql';
	}

	public function connect() {
		$database = array(
			'database' => $this->database_name,
			'username' => $this->username,
			'password' => $this->password,
			'host' => $this->host,
			'driver' => $this->driver,
		);

		Database::addConnectionInfo('ObservantRecordsDb', 'default', $database);
	}

	public function activate() {
		db_set_active('ObservantRecordsDb');
	}

	public function deactivate() {
		db_set_active();
	}

	public function set_database_name($database_name) {
		$this->database_name = $database_name;
	}

	public function set_username($username) {
		$this->username = $username;
	}

	public function set_password($password) {
		$this->password = $password;
	}

	public function set_host($host) {
		$this->host = $host;
	}

	public function set_driver($driver) {
		$this->driver = $driver;
	}

	public function get_database_name() {
		return $this->database_name;
	}

	public function get_username() {
		return $this->username;
	}

	public function get_password() {
		return $this->password;
	}

	public function get_host() {
		return $this->host;
	}

	public function get_driver() {
		return $this->driver;
	}
}
