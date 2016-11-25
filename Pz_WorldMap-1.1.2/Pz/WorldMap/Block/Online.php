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
 * - Custom Design, for layout, template, skin, style ...
 * - Custom Module, for new featuers, actions, and other custom functions.
 * - Product import/export, for import product from excel file or other online shop.
 * - Other DIY for magento.
 * 
 * @category    ZoSoft
 * @package     Pz_WorldMap
 * 
 * @author      Cheng Wei <cheng.wei@zosoft.net>
 * @version     $$Id: Online.php 76 2010-05-03 14:35:11Z cwei $$
 * @copyright   Copyright (C) 2010 Z.O. Software, China (http://www.zosoft.net)
 */

/**
 * Block of online map
 * 
 * @package     Pz_WorldMap
 * @author      Cheng Wei <cheng.wei@zosoft.net>
 * @version     $$Id: Online.php 76 2010-05-03 14:35:11Z cwei $$
 */
class Pz_WorldMap_Block_Online extends Pz_WorldMap_Block_Map_Abstract {

	/**
	 * prepare layout, set default template
	 */
	protected function _prepareLayout() {
		
		if (! $this->getTemplate()) {
			$this->setTemplate("worldmap/online.phtml");
		}
	
		parent::_prepareLayout();
	
	}

	/**
	 * @return array
	 */
	public function getVisitors() {
		return Mage::helper('worldmap')->getOnlineList();
	}

	/**
	 * @return string
	 */
	protected function getVisitorTitle($visitor) {
		if (! $visitor->getData('customer_id')) {
			$name = $this->__('Guest');
			$visitor->setData('customer_firstname', $name);
		} else if (! ! Mage::getStoreConfig('worldmap/setting/show_customer_name')) {
			$name = $visitor->getData('customer_firstname') . ' ' . $visitor->getData(
				'customer_lastname');
		} else {
			$name = $this->__('Customer');
		}
		$ip = long2ip($visitor->getData('remote_addr'));
		$ip = explode('.', $ip);
		$ip[count($ip) - 1] = '*';
		$ip = implode('.', $ip);
		$strtr = array('{CUSTOMER_NAME}'=>$name, '{REMOTE_IP}'=>$ip);
		foreach ($visitor->toArray() as $key => $val) {
			$strtr["{" . strtoupper($key) . "}"] = $val;
		}
		$fmt = Mage::getStoreConfig('worldmap/setting/marker_format');
		return strtr($fmt, $strtr);
	}

	/**
	 * @return string
	 */
	public function getVisitorsJson() {
		$data = array();
		foreach ($this->getVisitors() as $visitor) {
			$data[] = array(
				'latitude'=>$visitor->getData('latitude'), 
				'longitude'=>$visitor->getData('longitude'), 
				//'Location'=>$visitor->getData('Location'),
				'customer'=>$visitor->getData('customer_id') ? true : false, 
				'text'=>$this->getVisitorTitle($visitor));
		}
		return Zend_Json_Encoder::encode($data);
	}

}