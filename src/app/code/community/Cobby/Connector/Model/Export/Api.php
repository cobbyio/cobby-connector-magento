<?php
/**
 * Export API
 */
class Cobby_Connector_Model_Export_Api extends Mage_Api_Model_Resource_Abstract
{
    public function exportProducts($filterProductIds)
    {
        return Mage::getModel('cobby_connector/export_entity_product')
            ->exportProducts($filterProductIds);
    }
}