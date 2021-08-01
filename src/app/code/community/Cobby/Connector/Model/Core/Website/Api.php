<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

/**
 * Website API
 *
 */
class Cobby_Connector_Model_Core_Website_Api extends Mage_Api_Model_Resource_Abstract
{
    /**
     * Retrieve website list
     *
     * @return array
     */
    public function export()
    {
        // Retrieve websites
        $websites = Mage::app()->getWebsites(true, true);

        // Make result array
        $result = array();
        $sortOrder = 0;
        foreach ($websites as $website) {
            $result[] = array(
                'website_id'        => $website->getWebsiteId(),
                'code'              => $website->getCode(),
                'name'              => $website->getName(),
                'default_group_id'  => $website->getDefaultGroupId(),
                'is_default'        => $website->getIsDefault(),
                'sort_order'        => $sortOrder //$website->getSortOrder()
            );
            $sortOrder++;
        }

        return $result;
    }
}