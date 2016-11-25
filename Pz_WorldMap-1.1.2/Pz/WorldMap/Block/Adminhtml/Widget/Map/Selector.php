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
 * @version     $$Id: Selector.php 114 2010-10-20 06:02:02Z cwei $$
 * @copyright   Copyright (C) 2010 Z.O. Software, China (http://www.zosoft.net)
 */

/**
 * Link for world map
 * 
 * @package     Pz_WorldMap
 * @author      Cheng Wei <cheng.wei@zosoft.net>
 * @version     $$Id: Selector.php 114 2010-10-20 06:02:02Z cwei $$
 */
class Pz_WorldMap_Block_Adminhtml_Widget_Map_Selector extends Mage_Adminhtml_Block_Template {

	
	/**
	 * Prepare chooser element HTML
	 *
	 * @param Varien_Data_Form_Element_Abstract $element Form Element
	 * @return Varien_Data_Form_Element_Abstract
	 */
	public function prepareElementHtml(Varien_Data_Form_Element_Abstract $element) {
		$block = $this->getLayout()->createBlock('worldmap/adminhtml_widget_map_selector');
        
		$uniqId = Mage::helper('core')->uniqHash($element->getId());
        $block->setUniqId($uniqId);
        
		$element->setData('after_element_html', $block->toHtml());
		
		return $element;
	}
	/**
	 * 
	 */
	protected function _prepareLayout() {
		parent::_prepareLayout();
		$this->setTemplate('worldmap/widget/map/selector.phtml');
	}


	
}
