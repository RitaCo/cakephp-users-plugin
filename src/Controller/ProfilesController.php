<?php
namespace RitaUsers\Controller;


use Cake\Event\Event;
use RitaUsers\Controller\AppController;




class ProfilesController extends AppController
{


    protected $userID = null;


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
    }


    /**
     * ProfilesController::initialize()
     * 
     * @return void
     */
    public function initialize()
    {
        
        parent::initialize();
        $this->loadModel('RitaUsers.Users');    
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
            'section' =>true 
        ]);
    }
    
  
    /**
     * ProfilesController::personal()
     * 
     * @return void
     */
    public function personal()
    {
    
        $user = $this->Users->get($this->userID, ['contain' => 'Profiles']);
            
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user,$this->request->data, [
                'associated' => ['Profiles']
            ]);
            
            if($this->Users->save($user)) {
                $this->Flash->success('تغییرات با موفقیت ذخیره شدند.');
                return $this->redirect($this->request->params);
            } else {
                $this->Flash->error('عملیات ذخیره سازی باشکست ربرو شد.');
                $this->Flash->info('. لطفا مجدد سعی نمایید');                
            }            
        }
        
        $this->set('user',$user);
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
               return $this->redirect($this->request->params); 
            }
                $this->Flash->error('عملیات ذخیره سازی باشکست ربرو شد.');
                             
                        
        }
        
        $this->set('user',$user);
    }


    public function confirmList(){
        
        $lists = [];
        $this->set(compact('lists'));        
        
    }    
}