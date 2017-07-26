<?php 

$GLOBALS['config'] = [
	'path' => [
		'root' => __DIR__,
		'views' => __DIR__ . '/app/views',
		'postsImageDirectory' => 'public/img/posts/',
		'avatarsDirectory' => 'public/img/avatars/'
	],
	'database' => [
		'DB_TYPE' => 'mysql',
		'DB_NAME' => 'my-blog',
		'DB_HOST' => '127.0.0.1',
		'username' => 'root',
		'password' => ''
	],
	'cookie' => [
		'authTokenName' => 'SID',
		'authTokenExpire' => 60 * 60 * 24 * 7
	],
	'session' => [
		'userId' => 'id',
		'flashMessage' => 'flash',
		'currentPage' => 'curPage',
		'previousPage' => 'prevPage'
	],
	'default' => [
		'controller' => 'post',
		'action' => 'index',
	],
	'pageTitles' => [
		'default' => 'Blog portal',
		'auth/login' => 'Вход',
		'auth/register' => 'Регистрация',
	],
	'routes' => [		
		'profile/[0-9]' => 'profile/index',
		'article/[0-9]' => 'post/article',
	]
];