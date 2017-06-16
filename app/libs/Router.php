<?php 

class Router {

	//to redefine default controller or method use config.php
	protected $controller;
	protected $method;
	protected $parameters = [];

	protected $routes;

	public function __construct()
	{
		$this->controller = $GLOBALS['config']['default']['controller'];
		$this->method = $GLOBALS['config']['default']['method'];
		$this->routes = $GLOBALS['config']['routes'];

		$url = $this->parseUrl();		

		//Set controller (call 404 page)
		if (isset($url[0])) {
			if (array_key_exists($url[0], $this->routes) && (!is_array($this->routes[$url[0]]))) {
					if (preg_match('~/~', $this->routes[$url[0]])) {
						$matches = explode('/', $this->routes[$url[0]]);
						$this->controller = $matches[0];
						$this->method = $matches[1];
					} else {
					$this->controller = $this->routes[$url[0]];
					}
			} else {
				$this->controller = $url[0];
			}
			unset($url[0]);
		}

		//Check if controller exists or call 404
		if(file_exists($path = 'app/controllers/' . $this->controller . '.php')) {
			require_once $path;
		} else {
			echo '404: Controller doens\'t exist';
			exit ();
		}

		//Call method/action (default = index)
		if (isset($url[1])) {

			//check whether is route to url method
			$routeAction = null;
			if (array_key_exists($this->controller, $this->routes)) {
				foreach ($this->routes[$this->controller] as $pattern => $method) {
					//Delimeters should be ~ because of possible "/" in found string
					if ( preg_match("~$pattern~", $url[1]) ) {
						$routeAction = $method;
						break;
					}
				}
			}

			if ($routeAction) {
				$this->method = $routeAction;
			} else {
				$this->method = $url[1];
				unset($url[1]);
			}

		//SETTING DEFAULT METHOD FOR CONTROLLER
		} else if (array_key_exists($this->controller, $this->routes) && $this->method == $GLOBALS['config']['default']['method']) {
			if (array_key_exists('default', $routes[$this->controller]) ) {
				$this->method = $routes[$this->controller]['default'];
			}
		}

		//Creating a OBJECT of controller
		$this->controller = '\App\controllers\\' . $this->controller;
		$this->controller = new $this->controller();

		if (!method_exists($this->controller, $this->method)) {
		 	echo '404: Method doens\'t exist';
		 	exit ();
		} 
		
		//Get a parameters	
		$this->parameters = $url ? array_values($url) : [];

		//Call a method of given controller with params
		call_user_func_array([$this->controller, $this->method], $this->parameters);
		
	}
	public function parseUrl() {
		if (isset($_GET['url'])) {
			return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
		}
	}
}