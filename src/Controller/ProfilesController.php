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
        $this->loadModel('RitaUser.Users');    
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
    
        $user = $this->Users->get($this->userID);
            
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user,$this->request->data, [
                'fieldList' => ['first_name', 'last_name']
            ]);
            
            if($this->Users->save($user)) {
                $this->Flash->success('تغییرات با موفقیت ذخیره شدند.');
                $this->redirect($this->request->params);
            } else {
                $this->Flash->error('عملیات ذخیره سازی باشکست ربرو شد.');
                $this->Flash->info('. لطفا مجدد سعی نمایید');                
            }            
        }
        
        $this->set('user',$user);
    }
    
    
    public function password()
    {
        
    }
}