<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

class Cobby_Connector_Model_Stock_Item extends Mage_CatalogInventory_Model_Stock_Item
{
    /**
     * Unset old fields data from the object.
     *
     * $key can be a string only. Array will be ignored.
     *
     * @param string $key
     * @return Varien_Object
     */
    public function unsetOldData($key=null)
    {
        if (is_null($key)) {
            if($this->_oldFieldsMap) {
                foreach ($this->_oldFieldsMap as $key => $newFieldName) {
                    unset($this->_data[$key]);
                }
            }
        } else {
            unset($this->_data[$key]);
        }
        return $this;
    }
}
