<?php
use \Cake\Core\Configure;

Configure::write('Rita.Users', [


    'Register' => [
        'confirmEmail' => false,
        'confirmSms' => true,
        'roleID'   => 3,
         
    ],
    
    'metaFields' => [
        'confrimSms' => false,
        'last' => true
    
    ]




]);
require __DIR__ . '/events.php';
