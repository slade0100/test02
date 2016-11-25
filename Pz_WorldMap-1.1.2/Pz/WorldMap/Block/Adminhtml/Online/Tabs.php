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
 * @version     $$Id: Tabs.php 65 2010-04-10 14:36:12Z cwei $$
 * @copyright   Copyright (C) 2010 Z.O. Software, China (http://www.zosoft.net)
 */

/**
 * tabs of map
 * 
 * @package     Pz_WorldMap
 * @author      Cheng Wei <cheng.wei@zosoft.net>
 * @version     $$Id: Tabs.php 65 2010-04-10 14:36:12Z cwei $$
 */
class Pz_WorldMap_Block_Adminhtml_Online_Tabs extends Mage_Adminhtml_Block_Widget_Tabs {

	public function __construct() {
		parent::__construct();
		$this->setId('map_tabs');
		$this->setDestElementId('online_maps');
		$this->setTitle(Mage::helper('worldmap')->__('Online Customers'));
	}

	protected function _beforeToHtml() {
		
		$this->addTab('region_map', 
			array(
				'label'=>Mage::helper('worldmap')->__('Regions'), 
				'title'=>Mage::helper('worldmap')->__('Regions'), 
				'content'=>$this->getLayout()->createBlock(
					'worldmap/adminhtml_online_map_geomap')->setTemplate(
					'worldmap/map/country.phtml')->toHtml()));
		
		$this->addTab('marker_map', 
			array(
				'label'=>Mage::helper('worldmap')->__('Markers'), 
				'title'=>Mage::helper('worldmap')->__('Markers'), 
				'content'=>$this->getLayout()->createBlock(
					'worldmap/adminhtml_online_map_geomap')->setTemplate(
					'worldmap/map/region.phtml')->toHtml()));
		
		return parent::_beforeToHtml();
	}
}