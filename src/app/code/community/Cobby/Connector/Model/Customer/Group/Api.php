<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

class Cobby_Connector_Model_Customer_Group_Api extends Mage_Api_Model_Resource_Abstract
{
    /**
     * Retrieve custoemr group list
     *
     * @return array
     */
    public function export()
    {
        $result = array();

        $customerGroups = Mage::getModel('customer/group')->getCollection();
        foreach($customerGroups as $customerGroup){
            $groupData = $customerGroup->getData();

            $result[] = array(
                'group_id'  => $groupData['customer_group_id'],
                'name'      => $groupData['customer_group_code']
            );
        }

        return $result;
    }
}