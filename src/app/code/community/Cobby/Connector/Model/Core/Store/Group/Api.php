<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

/**
 * StoreGroup API
 */
class Cobby_Connector_Model_Core_Store_Group_Api extends Mage_Api_Model_Resource_Abstract
{
    /**
     * Retrieve store groups
     *
     * @return array
     */
    public function export()
    {
        $items = Mage::getModel('core/store_group')->getCollection();
        $result = array();

        foreach ($items as $item) {
            $result[] = array(
                'group_id' => $item->getGroupId(),
                'default_store_id' => $item->getDefaultStoreId(),
                'root_category_id' => $item->getRootCategoryId()
            );
        }
        return $result;
    }
}