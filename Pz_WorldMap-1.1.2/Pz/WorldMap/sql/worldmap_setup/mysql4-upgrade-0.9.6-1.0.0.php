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
 * @version     $$Id: mysql4-upgrade-0.9.6-1.0.0.php 65 2010-04-10 14:36:12Z cwei $$
 * @copyright   Copyright (C) 2010 Z.O. Software, China (http://www.zosoft.net)
 */

/* @var $installer Pz_WorldMap_Model_Entity_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("

	ALTER TABLE `{$installer->getTable('log/visitor_info')}`
		ADD `country_code` VARCHAR( 2 ) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL ,
		ADD `region_code` VARCHAR( 8 ) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL ,
		ADD `longitude` FLOAT NOT NULL ,
		ADD `latitude` FLOAT NOT NULL ,
		ADD `location` VARCHAR( 256 ) NOT NULL;

    ALTER TABLE `{$installer->getTable('log/visitor_online')}` 
    	ADD `country_code` VARCHAR( 2 ) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL ,
		ADD `region_code` VARCHAR( 8 ) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
		ADD `longitude` FLOAT NOT NULL ,
		ADD `latitude` FLOAT NOT NULL ,
		ADD `location` VARCHAR( 256 ) NOT NULL;
		
	ALTER TABLE `{$installer->getTable('log/visitor_online')}`
		ADD INDEX ( `country_code` , `region_code` ) ;

");

$installer->endSetup();
