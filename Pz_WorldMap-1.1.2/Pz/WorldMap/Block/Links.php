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
 * @version     $$Id: Links.php 61 2010-04-10 08:13:46Z cwei $$
 * @copyright   Copyright (C) 2010 Z.O. Software, China (http://www.zosoft.net)
 */

/**
 * Link for world map
 * 
 * @package     Pz_WorldMap
 * @author      Cheng Wei <cheng.wei@zosoft.net>
 * @version     $$Id: Links.php 61 2010-04-10 08:13:46Z cwei $$
 */
class Pz_WorldMap_Block_Links extends Mage_Core_Block_Template {

	/**
	 * Add world map link to parent block
	 *
	 * @return Mage_Checkout_Block_Links
	 */
	public function addWorldMapLink() {
		if ($parentBlock = $this->getParentBlock()) {
			if (Mage::getStoreConfig('worldmap/setting/show_frontend')) {
				$text = $this->__('Online Map');
				$parentBlock->addLink($text, 'worldmap', $text, true, array(), 80, null, 
					'class="top-link-worldmap"');
			}
		}
		return $this;
	}

}
