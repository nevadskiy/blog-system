<?php

class PostController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->userModel = new User;
		$this->postModel = new Post;
		$categories = $this->postModel->getCategoriesList();
		$this->view->data('categories', $categories);
	}

	public function indexAction() {
		$userId = $this->userModel->isLoggedIn() ? $this->userModel->data()->id : false;
		$posts = $this->postModel->getLatestPosts(10, $userId);
		$posts = (empty($posts)) ? [] : $posts;

		//userdata
		$this->view->render('main', 'post/posts-list', [
			'posts' => $posts
			]);
	}

	public function favAction() {
		if (Input::exists('fav')) {
			if (!$this->userModel->isLoggedIn()) {
				Redirect::back('You have to log in to do it!', 'danger');
			}
			$this->postModel->addPostToFavs(Input::get('fav'), Session::get(Config::get('session/userId')));
		}
		return Redirect::back();
	}

	public function createAction() {

		$post = new Post;
		$categories = $post->getCategoriesList();
		$this->view->data('categories', $categories);

		if (Input::exists('save')) {

			$validator = new Validator($_POST);

			$validator->addField('title')->addRules('require|max:240|min:5');
			$validator->addField('content')->addRules('require|min:20|max:16000');

			if ($validator->check()) {
				if (!empty($_FILES['post-image']['name'][0])) {
					try {
						$file = Uploader::save('post-image', Config::get('path/postsImageDirectory'));
						$postId = $post->createPost(Input::get('title'), Input::get('category'),Input::get('content'));
						$post->setPostImage($postId, $file);
					} catch (Exception $e) {
						$errors['file'] = $e->getMessage();
						$this->view->data('errors', $errors);
						return $this->view->render('main', 'post/create');
					}
				} else {
					$post->createPost(Input::get('title'), Input::get('category'),Input::get('content'));
				}
				Redirect::to('/', 'Post was successfully created!');
			} else {
				$this->view->data('errors', $validator->getErrors());
			}
		}
		return $this->view->render('main', 'post/create');
	}
	public function articleAction($postId = 1) {
		$postModel = new Post;
		$comment = new Comment;
		$user = new User;

		$userId = $user->isLoggedIn() ? $user->data()->id : false;

 		//URL TO ARTICLE NAME
		$url = strval($postId);
		$postId = (string) ((int) $postId);
 		// if ($url == $id) {
	 	// 	$title = strtolower($post->title);
	 	// 	$title = str_replace(' ', '-', $title);
	 	// 	Redirect::to("/article/$id-" . $title);
 		// } else {

		$post = $postModel->getPostById($postId, $userId);
		$comments = $comment->getCommentsByPostId($postId);

		$isYourPost = ($userId == $post->author_id);

		//views++
		if (!isset($_SESSION['views']) OR !in_array($postId, $_SESSION['views'])) {
			$postModel->updateViewsCount($postId);
			$_SESSION['views'][] = $postId;
		}


		//comments
		if (Input::exists('comment')) {
			$val = new Validator($_POST);
			$val->add('commentbody', 'Комментарий', 'require|min:3|max:360');
			if ($val->check()) {
				$comment->create(Input::get('commentbody'), $postId);
				Redirect::to("/article/{$postId}");
			} else {
				$this->view->data('errors', $errors);
			}
		}

		//deleting
		if (Input::exists('delete')) {
			if ($post->author_id == Session::get(Config::get('session/userId'))) {
				$postModel->deletePostById($postId);
				Redirect::to('/', 'You successfully deleted your post!', 'success');
			} else {
				Redirect::to('/', 'You have no right!', 'danger');
			}
		}
		

		return $this->view->render('main', 'post/single', [
			'post' => $post, 
			'comments' => $comments,
			'isYourPost' => false
			]);
	}

	public function editAction($postId) {
		$postModel = new Post;
		$post = $postModel->getPostById($postId);
		$categories = $postModel->getCategoriesList();	

		if (Input::exists('save')) {

			$validator = new Validator($_POST);
			$validator->addField('title')->addRules('require|max:240|min:5');
			$validator->addField('content')->addRules('require|min:20|max:16000');

			if ($validator->check()) {
				if (!empty($_FILES['post-image']['name'][0])) {
					try {
						$path = Uploader::save('post-image', Config::get('path/postsImageDirectory'));
						$postModel->setPostImage($post->id, $path);
						$postModel->updatePost($post->id, Input::get('title'), Input::get('category'),Input::get('content'));
					} catch (Exception $e) {
						$errors['file'] = $e->getMessage();
						$this->view->data('errors', $errors);
						return $this->view->render('main', 'post/create');
					}
				} else {
					$postModel->updatePost($post->id, Input::get('title'), Input::get('category'),Input::get('content'));
				}
				Redirect::to('/', 'Post was successfully updated!');
			} else {
				$this->view->data('errors', $validator->getErrors());
			}
		}

		return $this->view->render('main', 'post/edit', [
			'post' => $post,
			'categories' => $categories,
			]);
	}
	
	public function categoryAction($categoryId = null) {
		if (!$categoryId OR !is_int( (int) $categoryId)) {
			Redirect::to('/');
		}
		$post = new Post;
		$user = new User;

		$userId = $user->isLoggedIn() ? $user->data()->id : false;

		$posts = $post->getLatestPosts(10, $userId, ['category_id' => $categoryId]);
		return $this->view->render('main', 'post/posts-list', ['posts' => $posts]);
	}
}