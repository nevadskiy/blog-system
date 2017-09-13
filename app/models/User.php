<?php

class User extends Model {
	private $isLoggedIn,
	$data,
	$isAdmin = false;
	
	public function __construct() {
		parent::__construct();
		if (Session::exists(Config::get('session/userId'))) {
			$user = Session::get(Config::get('session/userId'));
			if ($this->get($user)) {
				$this->updateLastActivity($user);
				$this->isLoggedIn = true;
			} else {
				$this->logout();
			}

			//admin check
			$sql = "SELECT roles.role_name FROM users INNER JOIN roles ON users.role_id = roles.id WHERE users.id = {$user}";
			if ($this->db->sql($sql)[0]->role_name == 'Admin') {
				$this->isAdmin = true;
			}
		}
	}

	public function get($user = null) {
		if ($user) {
			$field = (is_numeric($user)) ? 'id' : 'username';
			$sql = "SELECT * FROM `users` 
			LEFT JOIN `users_profiles` ON users_profiles.user_id = users.id 
			WHERE users.{$field} = '{$user}'";
			$data = $this->db->sql($sql)[0];

			if ($data) {
				$this->data = $data;
				return $this;
			}
		}
		return false;
	}

	public function isLoggedIn() {
		return $this->isLoggedIn;
	}
	public function data() {
		return $this->data;
	}

	public function login($username, $password, $remember = false) {
		if ($this->checkPassword($username, $password)) {
			Session::set(Config::get('session/userId'), $this->data()->id);

			if ($remember) {
				$hashCheck = $this->db->get('users_sessions', ['user_id' => $this->data()->id]);
				if (empty($hashCheck)) {
					$hash = Hash::unique();
					$this->db->insert('users_sessions', [
						'user_id' => $this->data()->id,
						'hash' => $hash
						]);
				} else {
					$hash = $hashCheck->hash;
				}
				Cookie::set(Config::get('cookie/authTokenName'), $hash, Config::get('cookie/authTokenExpire'));
			}
			return true;
		}
		return false;
	}

	public function register($fields = []) {
		$salt = Hash::salt(32);
		$fields['password'] = Hash::make($fields['password'] . $salt);
		$fields['salt'] = $salt;
		$fields['role_id'] = 1;
		$fields['created_at'] = date('Y-m-d H:i:s');
		$userId = $this->db->insert('users', $fields);

		if (!$userId) {
			throw new Exception('Account was not created.');
		} else {
			$this->db->insert('users_profiles', ['user_id' => $userId, 'avatar' => 'public/img/defava.jpg']);
		}
	}

	public function logout() {
		if (Cookie::exists(Config::get('cookie/authTokenName'))) {
			$this->db->delete('users_sessions', ['user_id' => Session::get(Config::get('session/userId'))]);
			Cookie::delete(Config::get('cookie/authTokenName'));
		}
		Session::delete(Config::get('session/userId'));
		return true;
	}

	public function resetPassword($email) {
		$userId = $this->db->get('users_profiles', ['email' => $email])->user_id;

		if ($this->db->get('password_tokens', ['user_id' => $userId])) {
			$this->db->delete('password_tokens', ['user_id' => $userId]);
		}

		$token = Hash::unique();
		$link = Url::get() . '/' . $token;

		$expire = date('Y-m-d H:i:s', time() + 3 * 24 * 60 * 60);
		Mail::send($email, 'Recovery password', $link);

		return $this->db->insert('password_tokens', ['token' => $token, 'user_id' => $userId, 'expire' => $expire]);
	}
	public function checkPasswordToken($token, $delete = false) {
		$token = $this->db->get('password_tokens', ['token' => $token]);
		if ($token) {
			if (date('Y-m-d H:i:s') < date($token->expire)) {
				return $token->user_id;
			} else {
				$this->db->delete('password_tokens', ['token' => $token->token]);	
			}
		}
		return false;
	}

	public function checkPassword($userId, $password) {
		$user = $this->get($userId);
		if ($user && $this->data()->password == Hash::make($password, $this->data()->salt)) {
			return true;
		}
		return false;
	}

	public function updatePassword($userId, $password) {
		$this->db->delete('password_tokens', ['user_id' => $userId]);

		$salt = Hash::salt(32);
		$password = Hash::make($password . $salt);
		return $this->db->update('users', ['password' => $password, 'salt' => $salt], ['id' => $userId]);
	}

	public function updateInfo($userId, $field = []) {
		if ($field) {
			return $this->db->update('users', $field, ['id' => $userId]);
		}
	}


	public function isAdmin() {
		return $this->isAdmin;
	}
	public function getUsersList() {
		return $this->db->getAll('users');
	}

	public function updateLastActivity($id) {
		return $this->db->update('users_profiles', ['last_activity' => date('Y-m-d H:i:s')], ['user_id' => $id]);
	}
}