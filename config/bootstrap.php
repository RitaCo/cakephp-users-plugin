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
    
    ],

    'Profile' => [
        'importentField' => [
            'first_name',
            'last_name',
            'mobile',
            'sex',
        ]
    
    ]


]);
require __DIR__ . '/events.php';
