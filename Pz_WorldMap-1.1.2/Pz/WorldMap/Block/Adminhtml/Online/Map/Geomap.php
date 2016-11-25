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
 * @version     $$Id: Geomap.php 73 2010-05-02 16:06:19Z cwei $$
 * @copyright   Copyright (C) 2010 Z.O. Software, China (http://www.zosoft.net)
 */

/**
 * map for backend
 * 
 * @package     Pz_WorldMap
 * @author      Cheng Wei <cheng.wei@zosoft.net>
 * @version     $$Id: Geomap.php 73 2010-05-02 16:06:19Z cwei $$
 */
class Pz_WorldMap_Block_Adminhtml_Online_Map_Geomap extends Mage_Adminhtml_Block_Template {

	/**
	 * @return array
	 */
	public function getSummery() {
		return Mage::helper('worldmap')->getOnlineSummery();
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
		} else {
			$name = $visitor->getData('customer_email');
		}
		return sprintf("[%s] %s", $name, $visitor->getLocation());
	}

	/**
	 * @return string
	 */
	protected function getVisitorContent($visitor) {
		$html = array();
		if ($visitor->getCustomerId()) {
			$html[] = sprintf("<a href='%s' target='_blank'>%s</a>", 
				$this->getUrl('adminhtml/customer/edit', 
					array('id'=>$visitor->getData('customer_id'))), $this->__('Customer'));
			$html[] = sprintf("%s: %s %s", $this->__('Full Name'), 
				$visitor->getData('customer_firstname'), $visitor->getData('customer_lastname'));
			$html[] = sprintf("%s: %s", $this->__('Email'), $visitor->getData('customer_email'));
		} else {
			$html[] = $this->__('Guest');
		}
		$html[] = sprintf("%s: %s", $this->__('IP Address'), 
			long2ip($visitor->getData('remote_addr')));
		$html[] = sprintf("%s: %s", $this->__('Location'), $visitor->getData('Location'));
		return implode("<br/>", $html);
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
				'customer'=>$visitor->getData('customer_id') ? true : false, 
				'title'=>$this->getVisitorTitle($visitor), 
				'content'=>$this->getVisitorContent($visitor));
		}
		return Zend_Json_Encoder::encode($data);
	}

}
