<?php
namespace Rita\Users\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\Event;
use Cake\Event\EventManagerTrait;

class UserComponent extends Component
{

    
    
    
    protected $request;
    protected $response;
    protected $session;
    
    public function initialize(array $config)
    {
        $controller = $this->_registry->getController();
        $this->request = $controller->request;
        $this->response = $controller->response;
        $this->session = $controller->request->session();
        $this->config(\Cake\Core\Configure::read('Rita.Users'));
    }
    
    
    public function implementedEvents()
    {
        return [
            'Auth.afterIdentify' => 'onLoginCheckLists'
        ];
    }
    
    
    
    public function onLoginCheckLists(Event $event, $user)
    {
        
        $this->log($this->_config, 'debug');
        
        
    }        
    
    /**
     * UserComponent::_checkProfileIncomplete()
     * 
     * @param mixed $event
     * @param mixed $param
     * @return void
     */
    private function _checkProfileIncomplete(Event $event ,$param)
    {
        
        $fields = \Cake\Core\Configure::read('Rita.Users.Profile.fields');
        
        $check = 0;
        foreach($fields as $c){
            if (empty($param['profile'][$c]) or $param['profile'][$c] === null){
                $check++;
            }
        }
   
        if($check !== 0 ){
            $this->session->write('profile.Incomplete', true);
        }
    }    
}
