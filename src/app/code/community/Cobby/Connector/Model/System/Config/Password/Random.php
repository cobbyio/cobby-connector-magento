<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

class Cobby_Connector_Model_System_Config_Password_Random extends Mage_Adminhtml_Model_System_Config_Backend_Encrypted
{
    protected function _afterLoad()
    {
        $value = Mage::helper('core')->getRandomString($length = 20);
        $this->setValue($value);
    }
}