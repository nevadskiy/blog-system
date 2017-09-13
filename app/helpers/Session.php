<?php

class Session {

	private static $_isSessionStarted = false;

	public static function start() {
		if (self::$_isSessionStarted == false) {
			session_start();
			self::$_isSessionStarted = true;
		}
	}

	public static function exists($name) {
		return (isset($_SESSION[$name])) ? true : false;
	}

	public static function set($name, $value) {
		return $_SESSION[$name] = $value;
	}

	public static function get($name) {
		return $_SESSION[$name];
	}

	public static function delete($name) {
		if (self::exists($name)) {	
			unset($_SESSION[$name]);
		}
	}

	public static function saveURL() {
		$curPage = Config::get('session/currentPage');
		$prevPage = Config::get('session/previousPage');
		if (self::exists($curPage)) {
			$temp = self::get($curPage);
		} else {
			$temp = '/';
		}
		self::set($prevPage, $temp);
		self::set($curPage, $_SERVER['REQUEST_URI']);
	}
}