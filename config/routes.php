<?php
use Cake\Routing\Router;

Router::plugin('RitaUsers', [ 'path' => '/users' ], function ($routes) {
	
 	$routes->connect('/',['controller' => 'index']);
	$routes->fallbacks();
});
