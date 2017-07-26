<?php 

class Bug extends Model {
	public function getBugsList() {
		return $this->db->featQuery('ORDER BY `done_status`')->getAll('bugs');
	}
	public function toggleDone($id) {
		if ($this->db->get('bugs', ['id' => $id])->done_status) {
			$this->db->update('bugs', ['done_status' => 0], ['id' => $id]);
		} else {
			$this->db->update('bugs', ['done_status' => 1], ['id' => $id]);
		}
		return true;
	}
	public function register($fields) {
		if (!$this->db->insert('bugs', $fields)) {
			throw new Exception('Bug wasn\'t registered');
		}
	}
	public function delete($id) {
		return $this->db->delete('bugs', ['id' => $id]);
	}
}

 ?>