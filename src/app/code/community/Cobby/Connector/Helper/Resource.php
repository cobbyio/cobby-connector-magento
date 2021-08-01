<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

/**
 * cobby resource helper
 */
class Cobby_Connector_Helper_Resource extends Mage_Core_Helper_Abstract
{
    /**
     * Find next value of autoincrement key for specified table.
     *
     * @param string $tableName
     * @throws Exception
     * @return string
     */
    public function getNextAutoincrement($tableName)
    {
        $connection  = Mage::getSingleton('core/resource')->getConnection('write');
        $entityStatus = $connection->showTableStatus($tableName);

        if (empty($entityStatus['Auto_increment'])) {
            Mage::throwException(Mage::helper('importexport')->__('Can not get autoincrement value'));
        }
        return $entityStatus['Auto_increment'];
    }

}
