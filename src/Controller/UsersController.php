<?php
namespace RitaUsers\Controller;


use Cake\Event\Event;
use RitaUsers\Controller\AppController;

class UsersController extends AppController {


    public function beforeFilter(Event $event)
    {
          parent::beforeFilter($event);
            $this->Auth->allow(['logout']);
    }


    public function login()
    {
        $this->Users->find('list');    
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('نام کاربری یا رمز عبور شما صحیح نمی‌باشد. لطفا مجدد سعی نمایید'));
        }
    }
    
/**
 * UsersController::logout()
 * 
 * @return
 */
    public function logout() 
    {
        return $this->redirect($this->Auth->logout());
    }

} 