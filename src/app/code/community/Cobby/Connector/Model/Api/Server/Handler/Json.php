<?php
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
