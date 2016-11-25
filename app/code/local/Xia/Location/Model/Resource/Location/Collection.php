<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/17
 * Time: 11:23
 */
class Xia_Location_Model_Resource_Location_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Constructor
     * Configures collection
     *
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('location/location');
    }

}