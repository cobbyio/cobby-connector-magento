<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

class Cobby_Connector_Model_System_Config_Source_Chooseuser
{
    public function toOptionArray()
    {
        $result = array();

        $apiUsers = Mage::getModel('cobby_connector/system_config_source_api_user')->toOptionArray();

        //show use existing, when api user with cobby permission exists
        if (count($apiUsers) > 0) {
            $result[] = array('value' => '', 'label'=>Mage::helper('cobby_connector')->__('Please Select'));
            $result[] = array('value' => 1, 'label'=>Mage::helper('cobby_connector')->__('Use Existing'));
        }

        $result[] = array('value' => 2, 'label'=>Mage::helper('cobby_connector')->__('Create New'));
        return $result;
    }
}
