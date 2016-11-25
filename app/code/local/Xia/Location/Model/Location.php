<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/17
 * Time: 12:16
 */
class Xia_Location_Model_Location extends Mage_Core_Model_Abstract
{
    /**
     * Initialize resource model
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('location/location');
    }

    public function getNameById($id)
    {
         return $this->_getResource()->getNameById($id);
    }
}