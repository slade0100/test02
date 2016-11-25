<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/24
 * Time: 10:37
 */
class Xia_Goods_Block_Goods extends Mage_Core_Block_Template
{
    public function getGoods()
    {
        return Mage::getModel('goods/goods')->getCollection();
    }
    public function goods(){
        $read = Mage::getSingleton("core/resource")->getConnection('core_read');
        $sql = "select * from 'goods'";
        $result = $read ->fetchAll($sql);
        return $result;
    }
}