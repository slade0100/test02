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
 * Visitor resource
 * 
 * @package     Pz_WorldMap
 * @author      Cheng Wei <cheng.wei@zosoft.net>
 * @version     $$Id: Visitor.php 61 2010-04-10 08:13:46Z cwei $$
 */
class Pz_WorldMap_Model_Entity_Visitor extends Mage_Log_Model_Mysql4_Visitor
{
    /**
     * Saving visitor information
     *
     * @param   Mage_Log_Model_Visitor $visitor
     * @return  Mage_Log_Model_Mysql4_Visitor
     */
    protected function _saveVisitorInfo($visitor)
    {
        /* @var $stringHelper Mage_Core_Helper_String */
        $stringHelper = Mage::helper('core/string');

        $referer    = $stringHelper->cleanString($visitor->getHttpReferer());
        $referer    = $stringHelper->substr($referer, 0, 255);
        $userAgent  = $stringHelper->cleanString($visitor->getHttpUserAgent());
        $userAgent  = $stringHelper->substr($userAgent, 0, 255);
        $charset    = $stringHelper->cleanString($visitor->getHttpAcceptCharset());
        $charset    = $stringHelper->substr($charset, 0, 255);
        $language   = $stringHelper->cleanString($visitor->getHttpAcceptLanguage());
        $language   = $stringHelper->substr($language, 0, 255);

        $write = $this->_getWriteAdapter();
        $data = array(
            'visitor_id'            => $visitor->getId(),
            'http_referer'          => $stringHelper->substr($visitor->getHttpReferer(), 0, 255),
            'http_user_agent'       => $stringHelper->substr($visitor->getHttpUserAgent(), 0, 255),
            'http_accept_charset'   => $stringHelper->substr($visitor->getHttpAcceptCharset(), 0, 255),
            'http_accept_language'  => $stringHelper->substr($visitor->getHttpAcceptLanguage(), 0, 255),
            'server_addr'           => $visitor->getServerAddr(),
            'remote_addr'           => $visitor->getRemoteAddr(),
        	'country_code'			=> $visitor->getCountryCode(),
        	'region_code'			=> $visitor->getRegionCode(),
        	'longitude'				=> $visitor->getLongitude(),
        	'latitude'				=> $visitor->getLatitude(),
        	'Location'				=> $visitor->getLocation(),
        );
        
        $write->insert($this->getTable('log/visitor_info'), $data);
        return $this;
    }

}
