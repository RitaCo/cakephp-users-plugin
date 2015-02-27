<?php
namespace Rita\Users\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\Event;
use Cake\Event\EventManagerTrait;
use Cake\Utility\Hash;

class CheckListComponent extends Component
{

    private $_sessionKey = 'Rita.User.checkList';
    
    
    protected $Controller;

    protected $Session;
    
    
 
    
    /**
     * UserComponent::initialize()
     * 
     * @param mixed $config
     * @return void
     */
    public function initialize(array $config)
    {
        $this->Controller = $this->_registry->getController();
        $this->Session = $this->Controller->request->session();
        $config =  \Cake\Core\Configure::read('Rita.Users');
        $this->config($config);
    }


    /**
     * UserComponent::startup()
     * 
     * @param mixed $event
     * @return void
     */
    public function startup(Event $event)
    {   
        
        $param = $this->Controller->request->params;
        $prefix = (isset($param['prefix'])) ? $param['prefix'] : false;

        if( $prefix !== 'client'){
            return true;
        }

        if( !$this->Controller->Auth->user('id') ){
            return true;
        }
        $checklists = $this->param();
        
        foreach($checklists as $task => $status) {
                return $this->_redirectTo($task,$param);
        
        }        
       
    }    

    /**
     * UserComponent::implementedEvents()
     * 
     * @return
     */
    public function implementedEvents()
    {
        return parent::implementedEvents() + [
            'Auth.afterIdentify' => 'onLoginCheckLists',
            'Auth.logout' => 'onLogOut'
        ];
    }
    

    /**
     * UserComponent::onLoginCheckLists()
     * 
     * @param mixed $event
     * @param mixed $user
     * @return void
     */
    public function onLoginCheckLists(Event $event, $user)
    {

        foreach($this->_config['CheckList'] as $key => $val ){
            if ( !$val['status'] ) {
                continue;
            }
            $res =  $this->{'_'.$key}($user);
            if($res) {
               $this->param($key, $res);
            }
        
        }
    }  


    
    /**
     * UserComponent::_redirectToCompleteProfile()
     * 
     * @param mixed $param
     * @return void
     */
    private function _redirectTo($task, $param)
    {
        
        $con = $this->_config['CheckList'][$task];
        
        if( !Hash::contains($param, $con['action']) ){
            $this->Controller->Flash->error($con['message']);
            return $this->Controller->redirect($con['action']);
        }
    }
    

    

    /**
     * UserComponent::onLogOut()
     * 
     * @return void
     */
    public function onLogOut(){
        $this->Session->delete($this->_sessionKey);
    }    
    
      
    
    /**
     * UserComponent::_completedProfile()
     * 
     * @param mixed $user
     * @return
     */
    private function _completedProfile($user)
    {
        $profileFields = $this->_config['Profile']['fields'];
    
        foreach($profileFields as $c){
            //or $param['profile'][$c] === null
            if (empty($param['profile'][$c]) ){
                return false;
            }
        }
 
        return true;
    }    


    /**
     * UserComponent::confirmedMobile()
     * 
     * @param mixed $user
     * @return void
     */
    private function _confirmedMobile($user)
    {
        return true;
    }    
    
    /**
     * UserComponent::_confirmedEmail()
     * 
     * @param mixed $user
     * @return void
     */
    private function _confirmedEmail($user)
    {
        return true;
    }    

    

    /**
     * CheckListComponent::param()
     * 
     * @param mixed $key
     * @param mixed $value
     * @return
     */
    public function param($key = null , $value = null)
    {
        if($key === null) {
            $key =  $this->_sessionKey;
        } else {
            $key =  $this->_sessionKey.'.'.$key;
        }

        
        if ( $value === null ) {
            return $this->Session->read($key);
        }
        
        return $this->Session->write($key, $value);

    }
}
