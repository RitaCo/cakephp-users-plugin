<?php
use Cake\Event\Event;
use Cake\Event\EventManager;
Use Cake\Log\Log;

EventManager::instance()->attach(function (Event $event , $user) {
    
    //debug('sssss');
    debug($user);
    $event->subject()->Flash->info('aaaaaaaaaaa');
    
    
},'RitaUsers.afterRegister');