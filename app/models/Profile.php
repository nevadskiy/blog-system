<?php 

class Profile extends Model {
	public function getOnlineStatus($time) {
		$diff = time() - strtotime(date($time));
		if ($diff/60 < 5)  {
			return $onlineStatus = true;
		}
		return false;
		// var_dump((new DateTime(date('Y-m-d H:i:s')))->diff(new DateTime(date($profile->last_activity))));
	}
	public function updateProfile($userId, $fields = []) {

		//удалить пустые элементы массива
		$fields = array_diff($fields, array(''));
		
		if (isset($fields['avatar'])) {
			$profile = $this->db->get('users_profiles', ['user_id' => $userId]);
			if ($profile->avatar != 'public/img/defava.jpg' && file_exists($profile->avatar)) {
				unlink($profile->avatar);
			}	
		}

		return $this->db->update('users_profiles', $fields, ['user_id' => $userId]);
	}
	public function getCounts($userId) {
		$sql = "SELECT COUNT(DISTINCT fav_posts.id) AS count_favs, COUNT(DISTINCT comments.id) as count_comments, COUNT(DISTINCT posts.id) as count_posts 
		FROM users
		LEFT JOIN fav_posts ON fav_posts.user_id = users.id
		LEFT JOIN comments ON comments.author_id = users.id
		LEFT JOIN posts ON posts.author_id = users.id
		WHERE users.id = :user_id";

		return $this->db->sql($sql, [':user_id' => $userId])[0];
	}
}