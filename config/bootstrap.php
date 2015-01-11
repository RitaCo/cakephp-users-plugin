<?php
use \Cake\Core\Configure;

Configure::write('RitaUsers', [


    'Register' => [
        'confirmEmail' => true,
        'confirmSms' => true,
        'roleID'   => 3,
         
    ]




]);
require __DIR__ . '/events.php';
