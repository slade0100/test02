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
 * @version     $$Id: data.php 65 2010-04-10 14:36:12Z cwei $$
 * @copyright   Copyright (C) 2010 Z.O. Software, China (http://www.zosoft.net)
 */

/**
 * data helper
 * 
 * @package     Pz_WorldMap
 * @author      Cheng Wei <cheng.wei@zosoft.net>
 * @version     $$Id: data.php 65 2010-04-10 14:36:12Z cwei $$
 */
class Pz_WorldMap_Helper_Data extends Mage_Core_Helper_Abstract {

	protected $_ipDetector = null;

	protected $_items = null;

	protected $_summery = null;

	/**
	 * @return Pz_WorldMap_Model_Ip
	 */
	protected function getIpDetector() {
		if (! $this->_ipDetector) {
			$this->_ipDetector = Mage::getModel('worldmap/ip');
		}
		return $this->_ipDetector;
	}

	/**
	 * Get online customer list
	 * 
	 * @return array
	 */
	public function getOnlineList() {
		if ($this->_items === null) {
			/* @var $collection Mage_Log_Model_Mysql4_Visitor_Online_Collection */
			$collection = Mage::getModel('log/visitor_online')->prepare()->getCollection();
			
			$collection->addCustomerData();
			$items = $collection->getItems();
			unset($collection);
			
			$this->_items = $items;
		}
		return $this->_items;
	}

	/**
	 * Get online summery
	 * 
	 * @return array
	 */
	public function getOnlineSummery() {
		if ($this->_summery === null) {
			
			$items = $this->getOnlineList();
			$summery = array(
				'country'=>array(), 
				'region'=>array(), 
				'country_count'=>0, 
				'region_count'=>0);
			foreach ($items as $item) {
				if (($country = $item->getData('country_code'))) {
					if (! isset($summery['country'][$country])) {
						$summery['country_count'] ++;
						$summery['country'][$country] = 0;
						$summery['region'][$country] = array();
					}
					$summery['country'][$country] ++;
					$region = $item->getData('region_code');
					if (! isset($summery['region'][$country][$region])) {
						$summery['region_count'] ++;
						$summery['region'][$country][$region] = 0;
					}
					$summery['region'][$country][$region] ++;
				}
			}
			$this->_summery = $summery;
		}
		return $this->_summery;
	}

	/**
	 * Get full address
	 * 
	 * @return string
	 */
	public function getLocation($countryCode, $regionCode = null, $city = null, $zipCode = null) {
			$ipDetector = $this->getIpDetector();
			
		$tokens = array($ipDetector->getCountryName($countryCode));
		if ($region = $ipDetector->getRegionName($regionCode, $countryCode)) {
			if ($zipCode) {
				$region .= ' ' . $zipCode;
			}
			$tokens = array_unshift($tokens, $region);
		}
		if ($city) {
			array_unshift($tokens, $ipDetector->getCityName($city, $regionCode, $countryCode));
		}
		return implode(', ', $tokens);
	}
}
