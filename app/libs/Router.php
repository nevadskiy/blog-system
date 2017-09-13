<?php 

class Router {
	private $controller;
	private $method;
	private $url;

	public function __construct() {
		$this->routes = Config::get('routes');
		$this->controller = Config::get('default/controller');
		$this->action =  Config::get('default/action');
		$this->url = self::parseUrl();

		if (Router::findRoute()) {
			Router::go();
		} else {
			if (isset($this->url[0])) {
				$this->controller = $this->url[0];
				unset($this->url[0]);
			}
			if (isset($this->url[1])) {
				$this->action = $this->url[1];
				unset($this->url[1]);
			}
			Router::go();
		}
	}

	public function findRoute() {
		foreach ($this->routes as $route => $value) {
			$route = explode('/', $route);
			if (isset($this->url[1])) {
				if (isset($route[1]) && preg_match("~{$route[1]}~", $this->url[1]) && $route[0] == $this->url[0]) {
					if ($this->url[1] == $route[1]) {
						unset($this->url[1]);
					}
					if ($this->url[0] == $route[0]) {
						unset($this->url[0]);	
					}
					$value = explode('/', $value);
					$this->controller = $value[0];
					$this->action = $value[1];
					return true;
				}
			} else if (isset($this->url[0]) && preg_match("~{$route[0]}~", $this->url[0])) {
				if ($this->url[0] == $route[0]) {
					unset($this->url[0]);
				}
				$value = explode('/', $value);
				$this->controller = $value[0];
				$this->action = $value[1];
				return true;
			}
		}
		return false;
	}


	public function go() {
		//Setting right controller name and action name
		$this->controller = ucfirst($this->controller) . 'Controller';
		$this->action .= 'Action';
		//Get a parameters	
		$parameters = $this->url ? array_values($this->url) : [];

		if (class_exists($this->controller)) {
			//Creating a OBJECT of controller
			$this->controller = new $this->controller();
		} else {
			return Router::page404();
		}
		if (method_exists($this->controller, $this->action)) {
			return call_user_func_array([$this->controller, $this->action], $parameters);	
		} else {
			return Router::page404();
		}
	}

	public function parseUrl() {
		if (isset($_GET['url'])) {
			$url = $_GET['url'];
			unset($_GET['url']);
			return explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
		}
	}

	public function page404() {
		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		require_once (__DIR__ . '/../views/404.php');
		die();
	}
}