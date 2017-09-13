<?php 

class Title {
	public static function get() {
		$url = $_SERVER['REQUEST_URI'];
		$url = trim($url, '/');
		$titles = Config::get('pageTitles');
		if (isset($titles[$url])) {
			return $titles[$url];
		}
		return Config::get('pageTitles/default');
	}
}