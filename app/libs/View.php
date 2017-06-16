<?php

namespace App\libs;

class View {
	function __construct() {
		$this->viewsPath = $GLOBALS['config']['path']['views'];
	}
	
	public function render($name, $noInclude = false) {
		if ($noInclude) {
			include_once $this->viewsPath . $name . '.php';
		} else {
			include_once $this->viewsPath . 'template/header.php';
			include_once $this->viewsPath . $name . '.php';
			include_once $this->viewsPath . 'template/footer.php';
		}
	}
} 