<?php
use Cake\Routing\Router;

/**
 * Front Routes
 */

Router::scope('/', function($routes)
{
    $routes->connect(
        '/login',
        ['plugin' => 'Rita/Users', 'controller' => 'Users','action' => 'login']
    );
    
     $routes->connect(
         '/logout',
         ['plugin' => 'Rita/Users', 'controller' => 'Users','action' => 'logout']
     );
    
     $routes->connect(
         '/register',
         ['plugin' => 'Rita/Users', 'controller' => 'Users','action' => 'register']
     );

     $routes->fallbacks();
});


/**
 * Admin Routes
 */

Router::prefix('admin', function($routes)
{
    $routes->plugin('Rita/Users', [ 'path' => '/user-manger'], function($routes)
    {
        $routes->connect(
            '/',
            ['controller' => 'DashBoard','action' => 'index']
        );
        
        $routes->connect(
            '/profile/:id',
            ['plugin' => 'Rita/Users', 'controller' => 'Profiles','action' => 'index'],
            [
                'id' => '[0-9]+',
                'pass' => ['id']
            ]
        
        );

        $routes->connect(
            '/profile/:id/:action/*',
            ['plugin' => 'Rita/Users', 'controller' => 'Profiles'],
            [
                'id' => '[0-9]+',
                'pass' => ['id']
            ]
        
        );
        $routes->fallbacks();
    });
});


/**
 *  Client Router
 */
Router::prefix('client', function($routes)
{
    $routes->connect(
        '/profile',
        ['plugin' => 'Rita/Users', 'controller' => 'Profiles','action' => 'index']
        
    );


    $routes->connect(
        '/profile/activation/mobile/*',
        ['plugin' => 'Rita/Users', 'controller' => 'Profiles','action' => 'activeMobile']
        
    );

    $routes->connect(
        '/profile/activation/email/*',
        ['plugin' => 'Rita/Users', 'controller' => 'Profiles','action' => 'activeEmail']
        
    );

    $routes->connect(
        '/profile/:action/*',
        ['plugin' => 'Rita/Users', 'controller' => 'Profiles']
        
    );




});
