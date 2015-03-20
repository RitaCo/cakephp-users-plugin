<?php
use \Cake\Core\Configure;

Configure::write('Rita.Users', [

/**
 * Auth Config
 */
    'AuthConfig' => [
        'authorize' => ['Controller'],
        'authenticate' => [
            'Form' => [
                'fields' => ['username' => 'email', 'password' => 'password'],
                'contain' => ['Profiles'],
                'userModel' => 'Rita/Users.Users',
            ]
        ], 
        'loginAction' => [
            'prefix'=> false,
            'controller' => 'Users',
            'action' => 'login',
            'plugin' => 'Rita/Users'
        ], 
        'authError' => 'دسترسی برای شما مقدور نمی‌باشد',
        'loginRedirect' => '/client',
        'logoutRedirect' => '/',
    
    ],    
     
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
    'loginCheckList' => [
       'completedProfile' => true,
       'confirmedEmail' => false,
       'confirmedMobile' => true 
    ],
    
    'CheckList' => [
       'completedProfile' => [
           'status' => true,
           'message' => 'لطفا پروفایل خودتون را کامل کنید.',
           'action' => [
            	'plugin' => 'Rita/Users',
            	'controller' => 'Profiles',
            	'action' => 'personal',
            	'prefix' => 'client'
           ]
       ],
       'confirmedEmail' => [
           'status' => false,
           'message' => 'لطفا پروفایل خودتون را کامل کنید.',
           'action' => [
            	'prefix' => 'client',
            	'plugin' => 'Rita/Users',
            	'controller' => 'Profiles',
            	'action' => 'activeEmail'
           ]        
        ],
       'confirmedMobile' => [
           'status' => true,
           'message' => 'جهت تکمیل فرایند اهراز هویت و فعال سازی محیط کاربری الزامیست یک شماره موبایل در سیستم ثبت  و  آن را فعال نمایید.',
           'action' => [
            	'prefix' => 'client',
                'plugin' => 'Rita/Users',
            	'controller' => 'Profiles',
            	'action' => 'activeMobile',

            ] 
        ]
    ]
]);
require __DIR__ . '/events.php';
