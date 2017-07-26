<?php

class View {
	public function render($template, $contentPage, $data = null) {
		//extracting $this->data
		if (!empty($this->data)) {
			extract($this->data);
		}
		//extracting $data
		if (is_array($data)) {
			extract($data);
		}
		//include template
		if ($template) {
			return require_once Config::get('path/views') . '/templates/' . $template . '.php';	
		} else {
			return require_once Config::get('path/views') . '/' . $contentPage . '.php';
		}
	}
	public function data($key, $data) {
		return $this->data[$key] = $data;
	}
}