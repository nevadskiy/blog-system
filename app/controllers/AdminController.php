<?php

class AdminController extends Controller {

	public function __construct() {
		parent::__construct();
		$user = new User;
		if (!$user->isAdmin()) {
			Redirect::to('/', 'You have no right!');
		}
	}

	public function bugtrackerAction($id = null, $action = 'check') {
		$this->bug = new Bug;
		$bugs = $this->bug->getBugsList();

		//Switch DONE and UNDONE id ID is sent
		if ($id && $action == 'check') {
			$this->bug->toggleDone($id);
			Redirect::to('/admin/bugtracker');
		} else if ($id && $action == 'delete') {
			$this->bug->delete($id);
			Redirect::to('/admin/bugtracker');
		}

		//Register new Bug
		if (isset($_POST['register'])) {
			$validator = new Validator($_POST);
			$validator->addField('bug')->addRules('require|min:10|max:100');
			
			if ($validator->check()) {
				$bug = new Bug;
				$bug->register(['name' => Input::get('bug')]);
				Redirect::to('/admin/bugtracker');
			} else {
				$this->view->errors = $validator->getErrors();
			}
		}		
		$this->view->render('main', 'admin/bugs', ['bugs' => $bugs]);
	} 

	public function usersAction() {
		$user = new User;
		$usersList = $user->getUsersList();
		$this->view->render('main', 'admin/users', ['users' => $usersList]);	
	}
}