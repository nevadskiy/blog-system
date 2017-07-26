<?php 

class ProfileController extends Controller {

	public function layout($id = null) {
		$userModel = new User;
		$profileModel = new Profile;

		if (!$userModel->isLoggedIn() && !$id) {
			Redirect::to('/', 'You should logged in', 'danger');
		}
		if ( ($userModel->isLoggedIn() && !$id) OR ($id == $userModel->data()->id)) {
			$isYourProfile = true;
			$id = Session::get(Config::get('session/userId'));
			$profile = $userModel->data();
		} else {
			$profile = $userModel->get($id)->data();
			$isYourProfile = false;
		}

		$online = $profileModel->getOnlineStatus($profile->last_activity);
		$counts = $profileModel->getCounts($id);

		$this->view->data('isYourProfile', $isYourProfile);
		$this->view->data('profile', $profile);
		$this->view->data('online', $online);
		$this->view->data('counts', $counts);
	}
	
	public function indexAction($userId = null) {
		$this->layout($userId);
		return $this->view->render('main', 'user/profile');
	}

	public function editAction() {
		$userModel = new User;
		$profileModel = new Profile;

		if (!$userModel->isLoggedIn() && !$id) {
			Redirect::to('/', 'You should logged in', 'danger');
		}

		$userId = Session::get(Config::get('session/userId'));

		$profileInfo = $userModel->data();

		if (Input::exists('save')) {

			$val = new Validator($_POST);

			if (Input::exists('first_name')) {
				$val->add('first_name', 'Имя', 'min:2|max:15');
			}
			if (Input::exists('last_name')) {
				$val->add('last_name', 'Фамилия', 'min:2|max:15');
			}
			if (Input::exists('email')) {
				$val->add('email', 'Email', 'filter_email|unique:users_profiles');
			}
			if (Input::exists('city')) {
				$val->add('city', 'Город', 'min:2|max:15');
			}
			if (Input::exists('birthday')) {
				$val->add('birthday', 'День рождения', 'filter_birthday');
			}
			if ($val->check()) {
				$profileModel->updateProfile($userId ,[
					'first_name' => Input::get('first_name'),
					'last_name' => Input::get('last_name'),
					'email' => Input::get('email'),
					'city' => Input::get('city'),
					'birth_day' => Input::get('birthday')
					]);
				Redirect::back('Профиль обновлен');
			} else {
				$this->view->data('errors', $val->getErrors());
			}
		}
		return $this->view->render('main', 'user/edit', ['profileInfo' => $profileInfo]);
	}
	public function commentsAction($userId = null) {
		$user = new User;
		if (!$userId) {
			$userId = Session::get(Config::get('session/userId'));
		}
		$this->layout($userId);

		$commentModel = new Comment;
		$comments = $commentModel->getCommentsByUserId($userId);

		return $this->view->render('main', 'user/profile', [
			'comments' => $comments,
			'layout' => Config::get('path/views/') . '/user/comments.php'
			]);
	}
	public function favsAction($userId = null) {
		$user = new User;
		if (!$userId) {
			$userId = Session::get(Config::get('session/userId'));
		}
		$this->layout($userId);
		$postModel = new Post;

		$posts = $postModel->getFavsPostByUserId($userId);
		return $this->view->render('main', 'user/profile', [
			'posts' => $posts,
			'layout' => Config::get('path/views/') . '/user/posts.php'
			]);
	}

	public function postsAction($userId = null) {
		$user = new User;
		$post = new Post;
		if (!$userId) {
			$userId = Session::get(Config::get('session/userId'));
		}
		$this->layout($userId);
		$posts = $post->getPostsByUserId($userId);

		return $this->view->render('main', 'user/profile', [
			'posts' => $posts,
			'layout' => Config::get('path/views/') . '/user/posts.php'
			]);
	}
}