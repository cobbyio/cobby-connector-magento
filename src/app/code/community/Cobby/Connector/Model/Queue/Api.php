<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

class Cobby_Connector_Model_Queue_Api extends Mage_Api_Model_Resource_Abstract
{
    public function export($minQueueId, $pageSize)
    {
        $result = array();
        $items = Mage::getResourceModel('cobby_connector/queue_collection')
            ->addMinQueueIdFilter($minQueueId)
            ->setPageSize($pageSize)
            ->setCurPage(1);
    
        // iterate through station count and create file in each station folder
        foreach ($items as $item) {
            $result[] = $item->getData();
        }

        return $result;
    }

    public function getMaxQueueId()
    {
        $items = Mage::getResourceModel('cobby_connector/queue_collection')->setOrder('queue_id', 'DESC')->setPageSize(1);

        if(count($items))
        {
            return array( 'result' => $items->getFirstItem()->getData('queue_id') );
        }
        return array( 'result' => 0);
    }

	public function reset()
	{
		$queue = Mage::getModel('cobby_connector/queue');
        try {
            $queue->reset();
        } catch (Exception $e) {
            Mage::logException($e);
			return array( 'result' => false);
        }
		return array( 'result' => true);
	}
}