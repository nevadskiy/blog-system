<?php

class Model {
	public $db;

	public function __construct() {
		$this->db = QueryBuilder::getInstance();
		$this->checkCookieToken();
	}

	public function checkCookieToken() {
		if (Cookie::exists(Config::get('cookie/authTokenName')) && !Session::exists(Config::get('session/userId'))) {
			$hash = Cookie::get(Config::get('cookie/authTokenName'));
			$hashCheck = $this->db->get('users_sessions', ['hash' => $hash]);

			if (!empty($hashCheck)) {
				Session::set(Config::get('session/userId'), $hashCheck->user_id);
			}
		}
	}
}