<?php
namespace Rita\Users\Model\Entity;

use Cake\Log\log;
use Rita\Core\ORM\Entity;

/**
 * UserProfile Entity.
 */
class Profile extends Entity
{
    
    
    
    protected $_virtual = [
        'full_name',
        'newmob'
        
    ]; 

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'first_name' => true,
        'last_name' => true,
        'phone' => true,
        'mobile' => true,
        'sex' => true,
        'brith' => true,
        'avatarEmail' => true,
        'websiteUrl' => true,
        'twitterUrl' => true,
        'facebookUrl' => true,
        'user' => true,
    ];

    /**
     * Profile::_getFullName()
     * 
     * @return
     */
    protected function _getFullName()
    {
        return $this->_properties['last_name'] . '  ' . $this->_properties['first_name'];
    }



    protected function _setMobile($mobile)
    {
        //$m = $this->_properties['mobile'];
        $m = [
          'current' => 09181117209,
          'changed' => false,
          'old' => null  
        
        ];
        //$this->set('mobile',$m);
        
        Log::debug($mobile);
        
        return $mobile;
    }
    
    protected function _getMobile($mobile)
    {
          //  Log::debug($this->_properties['mobile']);
        return [1,1];
    }        
            
}
