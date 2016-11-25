<?php

/**
 * Zing Outsourcing Software
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE_AFL.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zosoft.net so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * We supply professinal magento support.
 *  - Custom Design, for layout, template, skin, style ...
 *  - Custom Module, for new featuers, actions, and other custom functions.
 *  - Product import/export, for import product from excel file or other online shop.
 *  - Other DIY for magento.
 * 
 * @category    ZoSoft
 * @package     Pz_WorldMap
 * 
 * @author      Cheng Wei <cheng.wei@zosoft.net>
 * @version     $$Id: IndexController.php 70 2010-04-29 10:36:49Z cwei $$
 * @copyright   Copyright (C) 2010 Z.O. Software, China (http://www.zosoft.net)
 */

/**
 * World Map controllers
 * 
 * @package     Pz_WorldMap
 * @author      Cheng Wei <cheng.wei@zosoft.net>
 * @version     $$Id: IndexController.php 70 2010-04-29 10:36:49Z cwei $$
 */
class Pz_WorldMap_IndexController extends Mage_Core_Controller_Front_Action {
		
	/**
	 * Display template directly
	 */
	public function indexAction() {
		$this->loadLayout();
		$this->renderLayout();
	}
		
	public function testAction() {
		$ip = "59.173.55.123";
		$detect = Mage::getModel('worldmap/ip');
		$ret = $detect->parse($ip);
		var_dump($ret);
	}
}
