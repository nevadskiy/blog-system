<?php

namespace App\controllers;

//use Controller;

class Home extends \App\libs\Controller {

	function index() {

		$users = new \App\models\Home();
		$this->view->users = $users->getUsers();
		$this->view->render('index');
	}
}