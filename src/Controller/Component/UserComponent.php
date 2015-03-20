<?php
namespace Rita\Users\Controller\Component;

use Cake\Controller\Component;
use Cake\Event\Event;
use Cake\Event\EventManagerTrait;
use Cake\Utility\Hash;

class UserComponent extends Component
{

    protected $_controller;
    
    
  /**
   * UserComponent::__construct()
   * 
   * @param mixed $registry
   * @param mixed $config
   * @return void
   */
  public function __construct(\Cake\Controller\ComponentRegistry $registry, array $config = [])
  {
        $this->_controller = $registry->getController();
        $config =  \Cake\Core\Configure::read('Rita.Users')+$config;
        $this->_controller->loadComponent('Auth', $config['AuthConfig']);
        $this->_controller->loadComponent('Rita/Users.CheckList');
        

        parent::__construct($registry, $config);
        \Rita::$user = [];      
  }
  
    /**
     * UserComponent::initialize()
     * 
     * @param mixed $config
     * @return void
     */
    public function initialize(array $config)
    {
        $this->Session = $this->_controller->request->session();
        $this->config($config);

      
        
    }



      /**
       * UserComponent::isAuthorized()
       * 
       * @param mixed $user
       * @return
       */
      public function isAuthorized($user = null)
      {
           
        
        // Any registered user can access public functions
        $prefix = $this->request->param('prefix');
        
        

    

        // Only admins can access admin functions
        if ( $prefix === 'admin') {
            return $this->_adminIsAuthorized($user);
        } elseif ($prefix === 'client')
        {
            return $this->_clientIsAuthorized($user);
        }
        

        if (in_array($user['role_id'], [1,3]) and $prefix === 'client') {
            return true;
        }
        // Default deny
        return false;
      }
      
      
      
      /**
       * UserComponent::_adminIsAuthorized()
       * 
       * @param mixed $user
       * @return
       */
      private function _adminIsAuthorized($user)
      {
        $isAdmin = ($user['role_id'] === 1) ?  true : false;
        
        if( $isAdmin){
            return true;
        }
      }
      
      
      /**
       * UserComponent::_clientIsAuthorized()
       * 
       * @param mixed $user
       * @return
       */
      private function _clientIsAuthorized($user)
      {
        $isClient = ($user['role_id'] === 3) ?  true : false;
        
        if(!$isClient) {
           // $this->Flash->error('ادمین نمی‌تواند به سطح اعضا دسترسی پیدا کند.');
            //return $this->redirect('/admin/');
            
        }   
            
        return true;
      }


}
