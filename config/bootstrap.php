<?php
use \Cake\Core\Configure;

Configure::write('Rita.Users', [


    'Register' => [
        'confirmEmail' => true,
        'confirmSms' => true,
        'roleID'   => 3,
         
    ]




]);
require __DIR__ . '/events.php';
