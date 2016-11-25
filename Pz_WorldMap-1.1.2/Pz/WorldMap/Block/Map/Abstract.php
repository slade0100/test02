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
 * @version     $$Id: Abstract.php 122 2010-12-21 05:28:02Z cwei $$
 * @copyright   Copyright (C) 2010 Z.O. Software, China (http://www.zosoft.net)
 */

/**
 * Block of google map
 * 
 * @package     Pz_WorldMap
 * @author      Cheng Wei <cheng.wei@zosoft.net>
 * @version     $$Id: Abstract.php 122 2010-12-21 05:28:02Z cwei $$
 */
class Pz_WorldMap_Block_Map_Abstract extends Mage_Core_Block_Template implements 
	Mage_Widget_Block_Interface {
	
	protected static $mapJsEnabled = false;
	
	/**
	 * prepare layout, set default template
	 */
	protected function _prepareLayout() {
		
		parent::_prepareLayout();
		
		if (!$this->getMapId()) {
			$this->setMapId('map_' . md5(time() . rand(0, 999)));
		}
		if (!$this->getMapWidth()) {
			$this->setMapWidth(640);
		}
		if (!$this->getMapHeight()) {
			$this->setMapHeight(420);
		}
		if (!$this->getMapCenterLatitude()) {
			$this->setMapCenterLatitude(22.5);
		}
		if (!$this->getMapCenterLongitude()) {
			$this->setMapCenterLongitude(0);
		}
		if (!$this->getMapZoom()) {
			$this->setMapZoom(1);
		}
	}
	
	/**
	 * 
	 */
	protected function _beforeToHtml() {
		if (!self::$mapJsEnabled) {
			$protocal = 'http';
			$paddParam = "";
			
			$clientId = Mage::getStoreConfig('worldmap/googlemap/client_id');
			if (substr($clientId, 0, 4) == 'gme-') {
				$clientId = substr($clientId, 4);
			}
			if ($clientId) {
				$paddParam = "client=gme-$clientId&";
			}
			
			if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && $_SERVER['HTTPS'] != 'off') {
				if ($clientId) {
					$protocal .= 's';
				}
			}
			
			$html = "<script src='$protocal://www.google.com/jsapi'></script>";
			$html .= "<script type='text/javascript'>google.load('maps', '3', {other_params: '{$paddParam}sensor=false'});</script>";
			echo $html;
			
			self::$mapJsEnabled = true;
		}
	}

}