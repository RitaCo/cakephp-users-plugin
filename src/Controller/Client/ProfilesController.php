<?php
namespace Rita\Users\Controller\Client;

use Cake\Event\Event;
use Rita\Users\Controller\AppController;

class ProfilesController extends AppController
{


    protected $userID = null;
    protected $profileID = null;

    /**
     * ProfilesController::beforeFilter()
     *
     * @param mixed $event
     * @return void
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->userID = $this->Auth->user('id');
        $this->profileID= $this->Auth->user('profile.id');
    }


    /**
     * ProfilesController::initialize()
     *
     * @return void
     */
    public function initialize()
    {
        
        parent::initialize();
        $this->loadModel('Rita/Users.Users');
    }
    
    
    /**
     * ProfilesController::index()
     *
     * @return void
     */
    public function index()
    {
        $this->redirect([
            'action' => 'personal',
            
        ]);
    }
    
  
    /**
     * ProfilesController::personal()
     *
     * @return void
     */
    public function personal()
    {
    
        $Profile = $this->Profiles->get($this->profileID);
            
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Profiles->patchEntity($Profile, $this->request->data);
            
            if ($this->Profiles->save($Profile)) {
                $this->Flash->success('تغییرات با موفقیت ذخیره شدند.');
                return $this->redirect(['action' => 'personal']);
            } else {
                $this->Flash->error('عملیات ذخیره سازی باشکست ربرو شد.');
                $this->Flash->info('. لطفا مجدد سعی نمایید');
            }
        }
        
        $this->set('Profile', $Profile);
    }
    
    
    /**
     * ProfilesController::password()
     *
     * @return void
     */
    public function password()
    {
        $user = null;
        
        if ($this->request->is([ 'post', 'put'])) {
            $user = $this->Users->get($this->userID);
             //
              $this->request->data('password', $user->password);
            $user = $this->Users->patchEntity(
                $user,
                $this->request->data,
                ['validate' => 'password']
            );
                  
            if ($this->Users->save($user)) {
                $this->Flash->success('تغییرات با موفقیت ذخیره شدند.');
                return $this->redirect(['action' => 'password']);
            }
                $this->Flash->error('عملیات ذخیره سازی باشکست ربرو شد.');
                             
                        
        }
        
        $this->set('user', $user);
    }


    public function confirmList()
    {
        
        $lists = [];
        $this->set(compact('lists'));
        
    }
}
