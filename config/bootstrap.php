<?php
use \Cake\Core\Configure;

Configure::write('Rita.Users', [
/**
 *  user setting field save to json in meta field
 */
    
    'metaFields' => [
        'confrimSms' => false,
        'last' => true
    
    ],


    'Register' => [
        'confirmEmail' => false,
        'confirmSms' => true,
        'roleID'   => 3,
         
    ],
/**
 *  check importent field must completed with user
 */
    'Profile' => [
        'fields' => [
            'first_name',
            'last_name',
            'sex',
        ]
    
    ],

/**
 *  on user login be must checking this list
 */
    'onLoginCheckList' => [
       'incompleteProfile' => true,
       'confirmedEmail' => false, 
    ]
]);
require __DIR__ . '/events.php';
