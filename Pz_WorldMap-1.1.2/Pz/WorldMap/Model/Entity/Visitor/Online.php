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
 * @version     $$Id: Online.php 61 2010-04-10 08:13:46Z cwei $$
 * @copyright   Copyright (C) 2010 Z.O. Software, China (http://www.zosoft.net)
 */

/**
 * Visitor online resource
 * 
 * @package     Pz_WorldMap
 * @author      Cheng Wei <cheng.wei@zosoft.net>
 * @version     $$Id: Online.php 61 2010-04-10 08:13:46Z cwei $$
 */
class Pz_WorldMap_Model_Entity_Visitor_Online extends Mage_Log_Model_Mysql4_Visitor_Online {
	/**
	 * Initialize connection and define resource
	 *
	 */
	protected function _construct() {
		$this->_init('log/visitor_online', 'visitor_id');
	}
	
	/**
	 * Prepare online visitors for collection
	 *
	 * @param Mage_Log_Model_Visitor_Online $object
	 * @return Mage_Log_Model_Mysql4_Visitor_Online
	 */
	public function prepare(Mage_Log_Model_Visitor_Online $object) {
		if (($object->getUpdateFrequency() + $object->getPrepareAt()) > time()) {
			return $this;
		}
		
		$this->_getWriteAdapter()->beginTransaction();
		$this->_getWriteAdapter()->truncate($this->getMainTable());
		
		$visitors = array();
		$lastUrls = array();
		
		// retrieve online visitors general data
		$whereCond = sprintf('last_visit_at >= (? - INTERVAL %d MINUTE)', 
			$object->getOnlineInterval());
		$select = $this->_getReadAdapter()->select()->from($this->getTable('log/visitor'), 
			array('visitor_id', 'first_visit_at', 'last_visit_at', 'last_url_id'))->where(
			$whereCond, now());
		
		$query = $this->_getReadAdapter()->query($select);
		while ($row = $query->fetch()) {
			$visitors[$row['visitor_id']] = $row;
			$lastUrls[$row['last_url_id']] = $row['visitor_id'];
			$visitors[$row['visitor_id']]['visitor_type'] = Mage_Log_Model_Visitor::VISITOR_TYPE_VISITOR;
			$visitors[$row['visitor_id']]['customer_id'] = null;
		}
		
		if (!$visitors) {
			$this->commit();
			return $this;
		}
		
		// retrieve visitor remote addr
		$select = $this->_getReadAdapter()->select()->from(
			$this->getTable('log/visitor_info'), 
			array(
					'visitor_id', 
					'remote_addr', 
					'country_code', 
					'region_code', 
					'longitude', 
					'latitude', 
					'Location'))->where('visitor_id IN(?)', array_keys($visitors));
		$query = $this->_getReadAdapter()->query($select);
		while ($row = $query->fetch()) {
			$visitors[$row['visitor_id']]['remote_addr'] = $row['remote_addr'];
			$visitors[$row['visitor_id']]['country_code'] = $row['country_code'];
			$visitors[$row['visitor_id']]['region_code'] = $row['region_code'];
			$visitors[$row['visitor_id']]['longitude'] = $row['longitude'];
			$visitors[$row['visitor_id']]['latitude'] = $row['latitude'];
			$visitors[$row['visitor_id']]['Location'] = $row['Location'];
		}
		
		// retrieve visitor last URLs
		$select = $this->_getReadAdapter()->select()->from(
			$this->getTable('log/url_info_table'), array('url_id', 'url'))->where('url_id IN(?)', 
			array_keys($lastUrls));
		$query = $this->_getReadAdapter()->query($select);
		while ($row = $query->fetch()) {
			$visitorId = $lastUrls[$row['url_id']];
			$visitors[$visitorId]['last_url'] = $row['url'];
		}
		
		// retrieve customers
		$select = $this->_getReadAdapter()->select()->from(
			$this->getTable('log/customer'), array('visitor_id', 'customer_id'))->where(
			'visitor_id IN(?)', array_keys($visitors));
		$query = $this->_getReadAdapter()->query($select);
		while ($row = $query->fetch()) {
			$visitors[$row['visitor_id']]['visitor_type'] = Mage_Log_Model_Visitor::VISITOR_TYPE_CUSTOMER;
			$visitors[$row['visitor_id']]['customer_id'] = $row['customer_id'];
		}
		
		foreach ($visitors as $visitorData) {
			unset($visitorData['last_url_id']);
			$this->_getWriteAdapter()->insert($this->getMainTable(), $visitorData);
		}
		
		$this->_getWriteAdapter()->commit();
		
		$object->setPrepareAt();
		
		return $this;
	}
}
