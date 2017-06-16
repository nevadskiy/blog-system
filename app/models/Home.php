<?php

namespace App\models;

class Home extends \App\libs\Model {
	public function getUsers() {
		//return $this->db->query("SELECT * FROM users")->fetchAll();
		//change it with real query
		return [
			['id' => '1', 'data' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores est illo, recusandae, placeat labore consequuntur perspiciatis maxime quisquam fuga officiis repellat iste neque tempora? Perferendis, vitae, error! Suscipit, voluptas sint.'],
			['id' => '2', 'data' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores est illo, recusandae, placeat labore consequuntur perspiciatis maxime quisquam fuga officiis repellat iste neque tempora? Perferendis, vitae, error! Suscipit, voluptas sint.'],
			['id' => '3', 'data' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores est illo, recusandae, placeat labore consequuntur perspiciatis maxime quisquam fuga officiis repellat iste neque tempora? Perferendis, vitae, error! Suscipit, voluptas sint.'],
			['id' => '4', 'data' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores est illo, recusandae, placeat labore consequuntur perspiciatis maxime quisquam fuga officiis repellat iste neque tempora? Perferendis, vitae, error! Suscipit, voluptas sint.'],
		];
	}
}