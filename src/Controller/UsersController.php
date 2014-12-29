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
        \Cake\Log\Log::debug($this);
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
        $this->dispatchEvent('Controller.beforeUserRegister');
        if ($this->request->is('post')) {
            $user->role_id = 3;
			if ($this->Users->save($user)) {
			    
				$this->Flash->success('نام کاربری شما با موفقیت ایجاد شد.');
				$this->Flash->info(' ایمیل فعال سازی به ایمیل شما ارسال گردید، لطفا ایمیل خود را چک نمایید.');
                $this->dispatchEvent('RitaUsers.afterRegister',[$user]); 
				return $this->redirect(['action' => 'login']);
			} else {
				$this->Flash->error('عملیات شکست خورد. لطفا دلایل بروز مشکل را بررسی و مجدد سعی نمایید.');
			}
		}
        
		$this->set(compact('user'));        
        
    }
} 