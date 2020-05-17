<?php

return [
	// MainController for Users
	'' => [
		'controller' => 'main',
		'action' => '',
		'redirect' => 'main/index',
	],
	'main/index' => [
		'controller' => 'main',
		'action' => 'index',
	],

	//AJAX
	'ajax/index' => [
		'controller' => 'ajax',
		'action' => 'index',
	],
	'ajax/pages' => [
		'controller' => 'ajax',
		'action' => 'pages',
	],
	'ajax/pages/{page:\d+}' => [
		'controller' => 'ajax',
		'action' => 'pages',
	],

	// AdminController for Admin
	'admin/login' => [
		'controller' => 'admin',
		'action' => 'login',
	],
	'admin/logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],

];