<?php

class Controller {
	public function __construct() {
		Session::start();
		Session::saveURL();
		$this->view = new View();
	}
}