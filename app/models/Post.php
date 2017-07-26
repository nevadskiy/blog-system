<?php 

class Post extends Model {

	public function getLatestPosts($limit = 10, $userId = false, $filter = null) {
		$isLoggedInField = '';
		$isLoggedInJoin = '';
		if ($userId) {
			$isLoggedInField = ', fp.id AS isFaved';
			$isLoggedInJoin = 'LEFT JOIN fav_posts AS fp ON posts.id = fp.post_id AND fp.user_id = :user_id';
		}

		$sql = "SELECT posts.id, posts.title, posts.description, posts.views_count, posts.post_image, categories.name as cat_name, posts.category_id, users.id AS user_id, users.username, posts.created_at, COUNT(DISTINCT comments.id) AS comments, COUNT(DISTINCT fav_posts.id) AS favs {$isLoggedInField}
		FROM posts 
		INNER JOIN users ON posts.author_id = users.id 
		INNER JOIN categories ON posts.category_id = categories.id
		{$isLoggedInJoin}
		LEFT JOIN fav_posts ON posts.id = fav_posts.post_id
		LEFT JOIN comments ON posts.id = comments.post_id";

		if ($filter) {
			$field = key($filter);
			$sql .= " WHERE $field = $filter[$field]";
		}

		$sql .= " GROUP BY posts.id LIMIT $limit";

		return $this->db->sql($sql, [':user_id' => $userId]);
	}
	public function getPostById($id, $userId = false) {
		$isLoggedInField = '';
		$isLoggedInJoin = '';
		if ($userId) {
			$isLoggedInField = ', fp.id AS isFaved';
			$isLoggedInJoin = 'LEFT JOIN fav_posts AS fp ON posts.id = fp.post_id AND fp.user_id = :user_id';
		}
		return $this->db->sql("SELECT posts.id, posts.title, posts.views_count, posts.author_id, posts.content, posts.post_image, categories.name as cat_name, users.username, posts.created_at, COUNT(DISTINCT fav_posts.id) AS favs {$isLoggedInField} FROM posts INNER JOIN users ON posts.author_id = users.id INNER JOIN categories ON posts.category_id = categories.id 
			{$isLoggedInJoin}
			LEFT JOIN fav_posts ON posts.id = fav_posts.post_id
			WHERE posts.id = $id", [':user_id' => $userId])[0];
	}

	public function getPostsByUserId($userId) {
		return $this->db->getAll('posts', ['author_id' => $userId]);
	}

	public function getPostsByCategoryId($id) {
		return $this->db->featQuery('ORDER BY id DESC')->getAll('posts', ['category_id' => $id]);
	}

	private function makeDescription($content) {
		////
		$description = '';
		return $description;
	}

	public function createPost($title, $category, $content) {
		return $this->db->insert('posts', [
			'title' => $title,
			'content' => $content,
			'description' => substr(strip_tags($content), 0, 250) . '...',
			'category_id' => $this->db->get('categories',  ['name' => $category])->id,
			'author_id' => Session::get(Config::get('session/userId')),
			'created_at' => date('Y-m-d H:i:s')
			]);
	}

	public function updatePost($id, $title, $category, $content) {
		return $this->db->update('posts', [
			'title' => $title,
			'content' => $content,
			'description' => substr(strip_tags($content), 0, 250) . '...',
			'category_id' => $this->db->get('categories',  ['name' => $category])->id,
			'updated_at' => date('Y-m-d H:i:s')
			], ['id' => $id]);
	}


	public function setPostImage($id, $image) {
		$post = $this->db->get('posts', ['id' => $id]);
		if (!empty($post->post_image) && file_exists($post->post_image)) {
			unlink($post->post_image);
		}
		return $this->db->update('posts', ['post_image' => $image], ['id' => $id]);
	}

	public function getCategoriesList() {
		$sql = 'SELECT categories.*, count(posts.id) as count
		FROM categories LEFT JOIN posts
		ON posts.category_id = categories.id
		GROUP BY name
		ORDER BY categories.id';
		return $this->db->sql($sql);
	}
	public function updateViewsCount($postId) {
		return $this->db->sql("UPDATE `posts` SET views_count = views_count + 1 WHERE id = :post_id", [':post_id' => $postId]);
	}

	public function deletePostById($id) {
		$this->db->delete('posts', ['id' => $id]);
	}

	public function addPostToFavs($postId, $userId) {
		if (!$this->db->get('posts', ['id' => $postId])) {
			return false;
		}
		if($this->ifPostIsFaved($postId, $userId)) {
			//fav
			return $this->db->delete('fav_posts', ['post_id' => $postId, 'user_id' => $userId]);
		} else {
			//unfav
			return $this->db->insert('fav_posts', ['post_id' => $postId, 'user_id' => $userId]);
		}
	}

	public function ifPostIsFaved($postId, $userId) {
		$check = $this->db->get('fav_posts', ['post_id' => $postId, 'user_id' => $userId]);
		return ($check) ? true : false;
	}

	public function getFavsPostByUserId($userId) {
		$sql = "SELECT * FROM fav_posts INNER JOIN posts ON fav_posts.post_id = posts.id WHERE fav_posts.user_id = :user_id";
		return $this->db->sql($sql, [':user_id' => $userId]);
	}

}