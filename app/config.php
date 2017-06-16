<?php 

$GLOBALS['config'] = [
	'path' => [
		'domain' => '',
		'views' => __DIR__ . '/views/'
	],
	'database' => [
		'DB_TYPE' => 'mysql',
		'DB_NAME' => 'login',
		'DB_HOST' => '127.0.0.1',
		'username' => 'root',
		'password' => ''
	],
	'cookie' => [
		//cookie names
	],
	'session' => [
		//session names
	],
	'default' => [
		'controller' => 'home',
		'method' => 'index',
	],
	'routes' => [
		/**
		 * 1. redirect controller:
		 *		'uriController' => 'Controller'
		 *
		 * 2. redirect method:
		 * 		'Controller' => ['URI method' => 'controller method']
		 *   	or 
		 *   	'uriController' => 'Controller/method'
		 * 
		 * 3. set default method:
		 * 		'Controller' => [
		 * 			'default' => 'method'
		 * 		]
		 * 4. set method parameters:
		 * 		any pattern parameters like '[0-9]' => 'method'
		 */
		'main' => [
			'default' => 'home',
			'[0-9]' => 'home',
		],
		'product' => [
			'[0-9]' => 'index'
		],
		 'catalog' => [
		 	'[0-9]' => 'category'
		],
		'index' => 'home',
		'contact' => 'main/contact'
	]
];