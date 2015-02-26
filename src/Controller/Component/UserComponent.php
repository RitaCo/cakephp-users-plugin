<?php
namespace Rita\Users\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\Event;
use Cake\Event\EventManagerTrait;
use Cake\Utility\Hash;

class UserComponent extends Component
{

    private $_sessionKey = 'Rita.User';
    
    
    protected $Controller;

    protected $Session;
    
    
    protected $_profilesRoutes = [
    
        'profile' => [
        	'plugin' => 'Rita/Users',
        	'controller' => 'Profiles',
        	'action' => 'personal',
        	'prefix' => 'client'
        ],
        'activations' => [
        	'plugin' => 'Rita/Users',
        	'controller' => 'Profiles',
        	'action' => 'activations',
        	'prefix' => 'client'        
        ],

    ];    
    
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
        
        $config = $config + \Cake\Core\Configure::read('Rita.Users');
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
        $ProfileSession = $this->sessionManger('Profile');
         
        if(empty($ProfileSession)){
            return true;
        }
        
        $param = $this->Controller->request->params;

        $prefix = (isset($param['prefix'])) ? $param['prefix'] : false;

        if( $prefix !== 'client'){
            return true;
        }

        if( !$this->Controller->Auth->user('id') ){
            return true;
        }

        if( $ProfileSession['IsComplete'] === false) {
            return $this->_redirectToCompleteProfile($param);
        }
        
        
        //if (!$profile['IsComplete'])            
        
    }    

    /**
     * UserComponent::_redirectToCompleteProfile()
     * 
     * @param mixed $param
     * @return void
     */
    private function _redirectToCompleteProfile($param)
    {

        
        if( !Hash::contains($param, $this->_profilesRoutes['profile']) ){
            $this->Controller->Flash->error('لطفا مشخصات پروفایل خود را کامل نمایید.');
            return $this->Controller->redirect($this->_profilesRoutes['profile']);
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
     * UserComponent::onLogOut()
     * 
     * @return void
     */
    public function onLogOut(){
        $this->Session->delete($this->_sessionKey);
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
        $list = $this->_config['loginCheckList'];
        foreach($list as $task => $status){
            if ( $status === false ) {
                continue;
            } elseif ( $status === true ) {
                $this->{'_'.$task}($user);
            }
        }
    }        
    
    /**
     * UserComponent::_checkProfileIncomplete()
     * 
     * @param mixed $event
     * @param mixed $param
     * @return void
     */
    private function _incompleteProfile($user)
    {
        $profileFields = $this->_config['Profile']['fields'];
        
        $check = 0;
        foreach($profileFields as $c){
            if (empty($param['profile'][$c]) or $param['profile'][$c] === null){
                $check++;
            }
        }
   
        if($check === 0 ){
            $this->sessionManger('Profile.IsComplete', true);
        } else {
            $this->sessionManger('Profile.IsComplete', false);
        }
    }    
    
    
    
    /**
     * UserComponent::_sessionKey()
     * 
     * @param mixed $key
     * @return
     */
    public function sessionManger($key , $value = null)
    {
        $key =  $this->_sessionKey.'.'.$key;
        
        if ( $value === null ) {
            return $this->Session->read($key);
        }
        
        return $this->Session->write($key, $value);

    }
}
