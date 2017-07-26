<?php 

class Comment extends Model {
	public function getCommentsByPostId($postId) {
		$sql = "SELECT u.id, c.body, c.created_at, u.username, up.avatar FROM comments c 
		INNER JOIN users u ON c.author_id = u.id 
		INNER JOIN users_profiles up ON up.user_id = u.id
		WHERE c.post_id = :post_id";
		$comments = $this->db->sql($sql, ['post_id' => $postId]);
		return $comments;
	}

	public function create($comment, $postId) {
		if (!$this->db->insert('comments', [
			'post_id' => $postId,
			'author_id' => Session::get(Config::get('session/userId')),
			'body' => $comment,
			'created_at' => date('Y-m-d H:i:s')
			])) {
			throw new Exception('Comment wasnt created!');
	}
}
public function getCommentsByUserId($userId) {
	$sql = "SELECT comments.body, posts.id, posts.title, comments.created_at FROM comments 
	LEFT JOIN posts ON comments.post_id = posts.id
	WHERE comments.author_id = :author_id
	ORDER BY comments.created_at DESC";
	return $this->db->sql($sql, [':author_id' => $userId]);
}
}