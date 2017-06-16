<?php

namespace App\libs;

class Model {
	public $db;
	function __construct() {
		$this->db = new \App\classes\Database();
	}
}