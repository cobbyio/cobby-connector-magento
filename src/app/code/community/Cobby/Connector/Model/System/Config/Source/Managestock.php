<?php
/**
 * Created by PhpStorm.
 * User: Slavko
 * Date: 09.02.2017
 * Time: 16:25
 */

class Cobby_Connector_Model_System_Config_Source_Managestock
{
    public function toOptionArray()
    {
        return array(
            array(
                'value' => Cobby_Connector_Helper_Settings::MANAGE_STOCK_ENABLED,
                'label' => Mage::helper('cobby_connector/settings')->__('enabled')
            ),
            array(
                'value' => Cobby_Connector_Helper_Settings::MANAGE_STOCK_READONLY,
                'label' => Mage::helper('cobby_connector/settings')->__('readonly')
            ),
            array(
                'value' => Cobby_Connector_Helper_Settings::MANAGE_STOCK_DISABLED,
                'label' => Mage::helper('cobby_connector/settings')->__('disabled')
            )
        );
    }
}