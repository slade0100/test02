<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/24
 * Time: 10:36
 */
class Xia_Goods_GoodsController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();

    }

    public function viewAction()
    {
        $id = $this->getRequest()->getParam('id');
        Mage::register('current_goods_id', $id);
        $this->loadLayout();
        $this->renderLayout();
        $read = Mage::getSingleton("core/resource")->getConnection('core_read');
        $sql = "select * from `goods`";
        $result = $read->fetchAll($sql);
        print_r($result);
    }
}