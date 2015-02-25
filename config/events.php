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




$check = function(Event $event ,$param){
   $session  = $event->subject()->session;
   $fields = \Cake\Core\Configure::read('Rita.Users.Profile.fields');
   $check = 0;
   foreach($fields as $c){
     if (empty($param['profile'][$c]) or $param['profile'][$c] === null){
        $check++;
     }
   }
   
   if($check !== 0 ){
    $session->write('profile.Incomplete', true);
   }
   
   
};

EventManager::instance()->attach($check, 'Auth.afterIdentify');

