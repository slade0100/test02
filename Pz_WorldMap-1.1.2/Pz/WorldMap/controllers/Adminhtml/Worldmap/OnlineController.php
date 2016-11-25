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
 * @version     $$Id: OnlineController.php 127 2011-01-28 09:54:41Z cwei $$
 * @copyright   Copyright (C) 2010 Z.O. Software, China (http://www.zosoft.net)
 */

/**
 * World Map for backend
 * 
 * @package     Pz_WorldMap
 * @author      Cheng Wei <cheng.wei@zosoft.net>
 * @version     $$Id: OnlineController.php 127 2011-01-28 09:54:41Z cwei $$
 */
class Pz_WorldMap_Adminhtml_Worldmap_OnlineController extends Mage_Adminhtml_Controller_Action {
	
	public function geomapAction() {
		$this->loadLayout();
		
		$region = $this->getRequest()->getParam('region');
		if (!$region) {
			$region = Mage::getStoreConfig('worldmap/setting/region_backend');
		}
		Mage::register('current_region', $region);
		
		$this->_setActiveMenu('customer/online/geomap');
		$this->_addBreadcrumb(Mage::helper('worldmap')->__('Geo Map'), 
			Mage::helper('worldmap')->__('Geo Map'));
		
		$this->_addContent(
			$this->getLayout()->createBlock('worldmap/adminhtml_online_map_geomap')->setTemplate(
				'worldmap/map/country.phtml'));
		
		$this->_addLeft(
			$this->getLayout()->createBlock('worldmap/adminhtml_online_map_geomap')->setTemplate(
				'worldmap/info/geomap.phtml'));
		
		$this->renderLayout();
	}
	
	public function markerAction() {
		$this->loadLayout();
		
		$this->_setActiveMenu('customer/online/geomap');
		$this->_addBreadcrumb(Mage::helper('worldmap')->__('Geo Map'), 
			Mage::helper('worldmap')->__('Geo Map'));
		
		$this->_addContent(
			$this->getLayout()->createBlock('worldmap/adminhtml_online_map_geomap')->setTemplate(
				'worldmap/map/marker.phtml'));
		
		$this->renderLayout();
	}

}
