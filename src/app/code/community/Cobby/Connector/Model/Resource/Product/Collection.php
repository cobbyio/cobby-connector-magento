<?php

class Cobby_Connector_Model_Resource_Product_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('cobby_connector/product');
    }
}
