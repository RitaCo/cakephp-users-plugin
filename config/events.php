<?php
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\Log\Log;

EventManager::instance()->attach(function (Event $event, $user) {
    $confirmEmail = $event->subject()->Users->getConfig('Register.confirmEmail');
    
    if (!$confirmEmail) {
        return;
    }
    
    $event->subject()->Flash->info(' ایمیل فعال سازی به ایمیل شما ارسال گردید، لطفا ایمیل خود را چک نمایید.');
    
}, 'RitaUsers.afterRegister');
