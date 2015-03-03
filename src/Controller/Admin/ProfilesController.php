<?php

namespace Rita\Users\Controller\admin;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Rita\Users\Controller\AppController;

/**
 * Roles Controller
 *
 * @property \RitaUsers\Model\Table\RolesTable $Roles
 */
class ProfilesController extends AppController
{

    public function index($id = null)
    {
        
        return $this->redirect([
            'action' => 'personal',
            'id' => $id
        ]);
    }
    
    
    
 public function personal($id = null)
    {
        $Users =  TableRegistry::get('Rita/Users.Users');
        $user = $Users->get($id,['contain' => 'Profiles']);
            
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $Users->patchEntity($user, $this->request->data);
            
            if ($Users->save($user)) {
                $this->Flash->success('تغییرات با موفقیت ذخیره شدند.');
                
                

                return $this->redirect(['action' => 'personal', $id]);
            } else {
                $this->Flash->error('عملیات ذخیره سازی باشکست ربرو شد.');
                $this->Flash->info('. لطفا مجدد سعی نمایید');
            }
        }
        
        $Roles = TableRegistry::get('Rita/Users.Roles')->find('list');
        $this->set('roles', $Roles);
        $this->set('userId', $id);
        $this->set('user', $user);
    }
    
    
    
    
    
    
       public function password($id = null)
    {
        
       $Users = TableRegistry::get('Rita/Users.Users');
       
        $user = $Users->newEntity();
        

        if ($this->request->is([ 'post', 'put'])) {
            $res = $Users->changePassword($$id,$this->request->data);
            $err = $res->errors();
            if (empty($err)) {
                $this->Flash->success('تغییرات با موفقیت ذخیره شدند.');
                return $this->redirect(['action' => 'password' ,$id]);
            }
                $user = $res;
                $this->Flash->error('عملیات ذخیره سازی باشکست ربرو شد.');
                             
                        
        }
             $this->set('userId', $id);
        $this->set('user', $user);
    }    
    
}
