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
 * @version     $$Id: Visitor.php 61 2010-04-10 08:13:46Z cwei $$
 * @copyright   Copyright (C) 2010 Z.O. Software, China (http://www.zosoft.net)
 */

/**
 * Visitor event observe
 * 
 * @package     Pz_WorldMap
 * @author      Cheng Wei <cheng.wei@zosoft.net>
 * @version     $$Id: Visitor.php 61 2010-04-10 08:13:46Z cwei $$
 */
class Pz_WorldMap_Model_Visitor extends Mage_Log_Model_Visitor {
	
	/**
	 * Initialize visitor information from server data
	 *
	 * @return Mage_Log_Model_Visitor
	 */
	public function initServerData() {
		parent::initServerData();
		
		if (!$this->hasData('region_code')) {
			
			$ip = long2ip($this->getRemoteAddr());
			
			$info = Mage::getModel('worldmap/ip')->parse($ip);
			$data['country_code'] = isset($info['country']) ? $info['country'] : '';
			$data['region_code'] = isset($info['region']) ? $info['region'] : '';
			$data['longitude'] = isset($info['longitude']) ? $info['longitude'] : '';
			$data['latitude'] = isset($info['latitude']) ? $info['latitude'] : '';
			$data['Location'] = isset($info['Location']) ? $info['Location'] : '';
			
			$this->addData($data);
		
		}
		
		return $this;
	}
}
