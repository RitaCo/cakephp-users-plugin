<?php
use Cake\Routing\Router;
Router::prefix('admin',function($routes){

    $routes->plugin('RitaUsers', [ 'path' => '/userManger' ], function ($routes) {
    	
     	$routes->connect('/',['controller' => 'Dashboard']);
    	$routes->fallbacks('InflectedRoute');
    });

});

Router::scope('/',function($routes){
    
    	
     	$routes->connect('/login',['plugin' => 'RitaUsers', 'controller' => 'Users','action' => 'login']);
     	$routes->connect('/logout',['plugin' => 'RitaUsers', 'controller' => 'Users','action' => 'logout']);
    	$routes->fallbacks('InflectedRoute');
    
});



Router::scope('/client',['section' => 'clients'],function($routes)
{
        
     	$routes->connect('/profile/:action/*',['plugin' => 'RitaUsers', 'controller' => 'Profiles','action' => 'index']);
    
    
});
