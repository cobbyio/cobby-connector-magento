<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
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