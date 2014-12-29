<?php
namespace RitaUsers\Controller;


use Cake\Event\Event;
use RitaUsers\Controller\AppController;

class UsersController extends AppController {


    public function beforeFilter(Event $event)
    {
          parent::beforeFilter($event);
            $this->Auth->allow(['logout','register']);
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



    public function register() {
        $user = $this->Users->newEntity($this->request->data);
        if ($this->request->is('post')) {
            $user->role_id = 3;
			if ($this->Users->save($user)) {
				$this->Flash->success('The user has been saved.');
				return $this->redirect(['action' => 'login']);
			} else {
				$this->Flash->error('عملیات با شکست خورد. لطفا دلایل بروز مشکل را بررسی و مجدد سعی نمایید.');
			}
		}
        
		$this->set(compact('user'));        
        
    }
} 