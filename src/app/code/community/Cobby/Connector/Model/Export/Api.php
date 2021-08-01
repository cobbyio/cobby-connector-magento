<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

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