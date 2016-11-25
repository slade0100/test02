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
 * @version     $$Id: Region.php 118 2010-10-23 14:21:37Z cwei $$
 * @copyright   Copyright (C) 2010 Z.O. Software, China (http://www.zosoft.net)
 */

/**
 * Source for backend configuration
 * 
 * @package     Pz_WorldMap
 * @author      Cheng Wei <cheng.wei@zosoft.net>
 * @version     $$Id: Region.php 118 2010-10-23 14:21:37Z cwei $$
 */
class Pz_WorldMap_Model_System_Config_Source_Region {

	protected $_options;

	public function toOptionArray() {
		if (! $this->_options) {
			$options = Mage::getResourceModel('directory/country_collection')->loadData()->toOptionArray(
				false);
			array_unshift($options, 
				array('value'=>'039', 'label'=>Mage::helper('worldmap')->__('Southern Europe')));
			array_unshift($options, 
				array('value'=>'155', 'label'=>Mage::helper('worldmap')->__('Western Europe')));
			array_unshift($options, 
				array('value'=>'154', 'label'=>Mage::helper('worldmap')->__('Northern Europe')));
			array_unshift($options, 
				array('value'=>'151', 'label'=>Mage::helper('worldmap')->__('Northern Asia')));
			array_unshift($options, 
				array('value'=>'145', 'label'=>Mage::helper('worldmap')->__('Middle East')));
			array_unshift($options, 
				array('value'=>'143', 'label'=>Mage::helper('worldmap')->__('Central Asia')));
			array_unshift($options, 
				array('value'=>'035', 'label'=>Mage::helper('worldmap')->__('Asia/Pacific')));
			array_unshift($options, 
				array('value'=>'034', 'label'=>Mage::helper('worldmap')->__('Southern Asia')));
			array_unshift($options, 
				array('value'=>'030', 'label'=>Mage::helper('worldmap')->__('Eastern Asia')));
			
			array_unshift($options, 
				array('value'=>'018', 'label'=>Mage::helper('worldmap')->__('Southern Africa')));
			array_unshift($options, 
				array('value'=>'015', 'label'=>Mage::helper('worldmap')->__('Northern Africa')));
			array_unshift($options, 
				array('value'=>'017', 'label'=>Mage::helper('worldmap')->__('Central Africa')));
			
			array_unshift($options, 
				array('value'=>'002', 'label'=>Mage::helper('worldmap')->__('All of Africa')));
			
			array_unshift($options, 
				array('value'=>'021', 'label'=>Mage::helper('worldmap')->__('North America')));
			
			array_unshift($options, 
				array('value'=>'013', 'label'=>Mage::helper('worldmap')->__('Central America')));
			
			array_unshift($options, 
				array('value'=>'005', 'label'=>Mage::helper('worldmap')->__('South America')));
			array_unshift($options, 
				array(
					'value'=>'us_metro', 
					'label'=>Mage::helper('worldmap')->__('United States, metro areas')));
			
			array_unshift($options, 
				array('value'=>'world', 'label'=>Mage::helper('worldmap')->__('Whole World')));
			
			$this->_options = $options;
		}
		
		return $options;
	}
}