<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

class Cobby_Connector_Model_Resource_Queue_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('cobby_connector/queue');
    }

    /**
     * @param int $minQueueId
     * @return Cobby_Connector_Model_Resource_Queue_Collection
     */
    public function addMinQueueIdFilter($minQueueId)
    {
        $this->addFieldToFilter($this->getResource()->getIdFieldName(), array('gteq' => $minQueueId));

        return $this;
    }

}
