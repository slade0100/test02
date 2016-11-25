<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/16
 * Time: 17:05
 */
class Xia_Location_Block_Location extends Mage_Core_Block_Template
{
    public function getLocation()
    {
        return Mage::getModel('location/location')->getCollection();
    }
}