<?php

class Redirect {
	public static function to($path, $message = null, $status = 'success') {
		if ($message) {
			Alert::setFlash($message, $status);
		}
		if (headers_sent()) {
			die("<script>window.location = '{$path}';</script>");
		} else {
			header("Location: {$path}");
			die();
		}
	}
	/**
	 * [redirect to the same page where submit button was clicked]
	 */
	public static function back($message = null, $status = 'success') {
		return self::to(Session::get(Config::get('session/previousPage')), $message, $status);
	}
}