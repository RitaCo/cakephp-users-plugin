<?php
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\Log\Log;
use Cake\Network\Session;

EventManager::instance()->attach(function (Event $event, $user) {
    $confirmEmail = $event->subject()->Users->getConfig('Register.confirmEmail');
    
    if (!$confirmEmail) {
        return;
    }
    
    $event->subject()->Flash->info(' ایمیل فعال سازی به ایمیل شما ارسال گردید، لطفا ایمیل خود را چک نمایید.');
    
}, 'Rita.Users.afterRegister');



