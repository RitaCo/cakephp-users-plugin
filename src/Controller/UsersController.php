<?php
namespace Rita\Users\Controller;

use \Cake\Core\Configure;
use Cake\Event\Event;
use Rita\Users\Controller\AppController;



class UsersController extends AppController
{


    /**
     * UsersController::beforeFilter()
     *
     * @param mixed $event
     * @return void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['logout','register']);
    }


    /**
     * UsersController::login()
     *
     * @return
     */
    public function login()
    {
        if ($this->Auth->user()) {
            return $this->redirect($this->Auth->redirectUrl());
        }
        
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



    /**
     * UsersController::register()
     *
     * @return
     */
    public function register()
    {
        if ($this->Auth->user()) {
            return $this->redirect($this->Auth->redirectUrl());
        }
        
        $user = $this->Users->newEntity($this->request->data);
     
        if ($this->request->is('post')) {
                 $this->Users->patchEntity($user, $this->request->data);
                $this->dispatchEvent('RitaUsers.Users.beforeRegister');
    
            if ($this->Users->register($user)) {
                $this->Flash->success('نام کاربری شما با موفقیت ایجاد شد.');
                $this->dispatchEvent('RitaUsers.Users.afterRegister', [$user]);
                return $this->redirect(['action' => 'login']);
            } else {
                $this->Flash->error('عملیات شکست خورد. لطفا دلایل بروز مشکل را بررسی و مجدد سعی نمایید.');
            }
        }
        
        $this->set('User', $user);
    }
}
