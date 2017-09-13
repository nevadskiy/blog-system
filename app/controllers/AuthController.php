<?php

class AuthController extends Controller {

	public function loginAction() {
		$user = new User;
		if ($user->isLoggedIn()) {
			Redirect::to('/', 'You are already logged in', 'danger');
		}
		if (Input::exists('login')) {
			$val = new Validator($_POST);
			$val->add('username', 'логин', 'require|min:4|max:16|filter_username|exists:users');
			$val->add('password', 'Пароль')->addRules('require');
			if ($val->check()) {
				if ($user->login(Input::get('username'), Input::get('password'), Input::get('remember'))) {
					Redirect::to('/');
				} else {
					$this->view->data('errors', ['password' => 'Неверный пароль']);
				}
			} else {
				$this->view->data('errors', $val->getErrors());
			}
		}
		return $this->view->render('main', 'auth/login');
	}

	public function registerAction() {
		$user = new User;
		if ($user->isLoggedIn()) {
			Redirect::to('/', 'You are already registered', 'danger');
		}
		
		if (Input::exists('register')) {
			$val = new Validator($_POST);
			$val->add('username', 'Логин', 'require|min:4|max:16|filter_username|unique:users');
			$val->add('password', 'Пароль')->addRules('require|min:4|max:16');
			$val->addField('repassword')->addRules('require|match:password')->addErrMsg('match' , 'Пароли не совпадают');

			if ($val->check()) {
				$user->register([
					'username' => Input::get('username', true),
					'password' => Input::get('password'),
					]);
				Redirect::to('/auth/login', 'You registered successfully');
			} else {
				$this->view->data('errors', $val->getErrors());
			}
		}
		return $this->view->render('main', 'auth/register');
	}

	public function editAction() {
		$userModel = new User;
		$profileModel = new Profile;

		if (!$userModel->isLoggedIn() && !$id) {
			Redirect::to('/', 'You should logged in', 'danger');
		}
		$userId = Session::get(Config::get('session/userId'));

		if (!empty($_FILES['avatar']['name'][0])) {
			try {
				$path = Uploader::save('avatar', Config::get('path/avatarsDirectory'));
				$profileModel->updateProfile($userId, ['avatar' => $path]);
				Redirect::back('Аватар обновлен');
			} catch (Exception $e) {
				$errors['file'] = $e->getMessage();
				$this->view->data('errors', $errors);
			}
		}

		if (Input::exists('update-login')) {
			$val = new Validator($_POST);
			$val->add('username', 'Логин', 'require|min:4|max:16|filter_username|unique:users');
			if ($val->check()) {
				$userModel->updateInfo($userId, ['username' => Input::get('username', true)]);
				Redirect::back('Имя пользователя обновлено');
			} else {
				$this->view->data('errors', $val->getErrors());
			}
		}

		if (Input::exists('update-email')) {
			$val = new Validator($_POST);
			$val->add('email', 'Email', 'filter_email');
			if ($val->check()) {
				$profileModel->updateProfile($userId, ['email' => Input::get('email', true)]);
				Redirect::back('Email обновлен');
			} else {
				$this->view->data('errors', $val->getErrors());
			}
		}

		if (Input::exists('update-password')) {
			$val = new Validator($_POST);
			$val->addField('oldpassword')->addRules('require|min:4|max:16');
			$val->addField('password')->addRules('require|min:4|max:16');
			$val->addField('repassword')->addRules('require|match:password')->addErrMsg('match' , 'Пароли не совпадают');

			if ($val->check()) {
				if ($userModel->checkPassword($userId, Input::get('oldpassword'))) {
					$userModel->updatePassword($userId, Input::get('password'));
					Redirect::back('Пароль обновлен');
				} else {
					$errors['oldpassword'] = 'Старый пароль введен неправильно';
					$this->view->data('errors', $errors);
				}
			} else {
				$this->view->data('errors', $val->getErrors());
			}
		}

		$profileInfo = $userModel->data();
		return $this->view->render('main', 'auth/edit', ['profileInfo' => $profileInfo]);
	}

	public function recoveryAction($token = null) {
		$resetForm = false;

		if ($token) {
			$user = new User;
			if ($userId = $user->checkPasswordToken($token)) {
				if (Input::exists('reset')) {
					$val = new Validator($_POST);
					$val->add('password', 'Пароль')->addRules('require|min:4|max:16');
					$val->addField('repassword')->addRules('require|match:password')->addErrMsg('match' , 'Пароли не совпадают');
					if ($val->check()) {
						$user->updatePassword($userId, Input::get('password'));
						Redirect::to('/auth/login', 'Пароль успешно изменен');
					} else {
						$this->view->data('errors', $val->getErrors());
					}
				} else {
					$resetForm = true;	
				}
			} else {
				Redirect::to('/auth/recovery', 'Неправильный токен here!', 'danger');
			}
		}

		if (Input::exists('sent')) {
			$val = new Validator($_POST);
			$val->add('email', 'Email', 'require|filter_email|exists:users_profiles');
			if ($val->check()) {
				$user = new User;
				$user->resetPassword(Input::get('email'));
				Redirect::to('/auth/recovery', 'Письмо с восстановлением пароля отпралено');
			} else {
				$this->view->data('errors', $val->getErrors());
			}
		}

		return $this->view->render('main', 'auth/recovery', ['resetForm' => $resetForm]);
	}

	public function logoutAction() {
		$user = new User;
		if ($user->isLoggedIn()) {
			$user->logout();
			Redirect::to('/');
		} else {
			Redirect::to('/', 'You are not even logged in', 'danger');
		}
	}
}