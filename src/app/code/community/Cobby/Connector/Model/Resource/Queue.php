<?php

class Cobby_Connector_Model_Resource_Queue extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('cobby_connector/queue', 'queue_id');
    }

    /**
     * @param Mage_Core_Model_Abstract $object
     * @return Cobby_Connector_Model_Resource_Queue
     */
    protected function _beforeSave(Mage_Core_Model_Abstract $object)
    {
        parent::_beforeSave($object);

        /** @var $dateModel Mage_Core_Model_Date */
        $dateModel = Mage::getModel('core/date');

        if ($object->isObjectNew()) {
            $object->setData('created_at', $dateModel->gmtDate());
        }

        //$object->setData('updated_at', $dateModel->gmtDate());

        return $this;
    }

    public function reset()
    {
        $this->_getWriteAdapter()->delete($this->getMainTable());
        return $this;
    }

}
