<?php
namespace Rita\Users\Controller\Client;

use Cake\Event\Event;
use Cake\ORM\TableRegistry;
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
                
                if (  $this->request->session()->check('Rita.User.checkList.completedProfile')){
                    $this->request->session()->delete('Rita.User.checkList.completedProfile');
                }
                

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
        
       $Users = TableRegistry::get('Rita/Users.Users');
       
        $user = $Users->newEntity();
        

        if ($this->request->is([ 'post', 'put'])) {
            $res = $Users->changePassword($this->userID,$this->request->data);
            
            if (empty($res->errors())) {
                $this->Flash->success('تغییرات با موفقیت ذخیره شدند.');
                return $this->redirect(['action' => 'password']);
            }
                $user = $res;
                $this->Flash->error('عملیات ذخیره سازی باشکست ربرو شد.');
                             
                        
        }
        
        $this->set('user', $user);
    }

    /**
     * ProfilesController::activeEmail()
     * 
     * @return void
     */
    public function activeEmail()
    {

    }


    /**
     * ProfilesController::activeMobile()
     * 
     * @return void
     */
    public function activeMobile()
    {
        $pro = $this->Profiles->get($this->profileID);
        $pro = $pro->mobile;
        $this->set('noMobile',$pro);
                
        if (!$this->request->session()->check('sms')) { 
        
            $Profile = $this->Profiles->newEntity();
    
            if ($this->request->is(['patch', 'post', 'put'])) {
                $Profile = $this->Profiles->patchEntity($Profile,$this->request->data(), ['validate' => 'mobile']);

                if(!$Profile->errors()){
                        $this->_sendSMS($this->request->data);    
            
                    
                }
            }
            $this->set('Profile', $Profile);
        } else {
                    
             $this->_smsActive($this->request->data);
        }
          
    }
    
    
    /**
     * ProfilesController::_sendSMS()
     * 
     * @param mixed $param
     * @return
     */
    private function _sendSMS($param)
    {
        
        $param['code'] = rand(1000,9999);
        
        
        
        if(!preg_match('/^09[123]\d{8}$/', $param['mobile'])){
            $this->Flash->info('شماره مبایل صحیح نمیباشد.لطفا با فرمت   09123456789 وارد کنید.');
            return;
        }
        $client = new \Cake\Network\Http\Client(['host' => 'parsasms.com']);
        $response =$client->get('/tools/urlservice/send/',[
            'username' => 'sepehr31330',
            'password' => '31330w',
            'from' => '30001818031330',
            'to' => $param['mobile'],
            'message' => 'کد فعال سازی : ' . $param['code'] 
        ]);
        
        if($response->body === "20"){
            $this->Flash->error('.این شماره اس ام اس تبلیغاتی را مسدود کرده است.');
            return;
            
        }
        $param['ref'] = $response->body;
        $this->request->session()->write('sms',$param); 
    }
  
  
  
    /**
     * ProfilesController::_smsActive()
     * 
     * @param mixed $data
     * @return
     */
    private function _smsActive($data)
    {
        $code = $this->request->session()->read('sms');
        
        if( (int)$data['active'] === (int)$code['code']){
            $profile =  $this->Profiles->get($this->profileID);
            $profile->mobile = $code['mobile'];
            $profile = $this->Profiles->save($profile,['validate' => false]);

            if(!$profile) {
                $this->Flash->info('خطا در فعال سازی');
                return false;    
            }   
        
            $this->request->session()->delete('sms');
            $this->request->session()->delete('Rita.User.checkList');
            $this->Flash->error('شماره موبایل شما مورد تایید قرار گرفت.');
            $this->redirect('/client');
            
        } else {
            $this->Flash->error('کد فعال سازسی صحیح نمی باشد.');
            return;        
        
        }
    }
}
