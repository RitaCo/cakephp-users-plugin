<?php
use Cake\Routing\Router;

Router::plugin('Users', function ($routes) {
	$routes->fallbacks();
});
