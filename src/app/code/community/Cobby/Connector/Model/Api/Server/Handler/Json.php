<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

/**
 * Webservice json server handler
 **/
class Cobby_Connector_Model_Api_Server_Handler_Json extends Mage_Api_Model_Server_Handler_Abstract
{
    public function processingMethodResult($result)
    {
        return $result;
    }
}
