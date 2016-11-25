<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/24
 * Time: 10:28
 */
class Xia_Goods_Model_Resource_Goods extends Mage_Core_Model_Resource_Db_Abstract
{
    protected  function _construct()
    {
        $this->_init('goods/goods','id');
        // TODO: Implement _construct() method.
    }
}