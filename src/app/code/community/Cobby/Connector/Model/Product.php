<?php

class Cobby_Connector_Model_Product extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('cobby_connector/product');
    }

    public function resetHash($prefix)
    {
        $hash = $prefix.' '.Mage::helper('core')->getRandomString(30);

        $this->_getResource()->resetHash($hash);

        return $this;
    }

    public function updateHash($ids)
    {
        $hash = Mage::helper('core')->getRandomString(30);

        if (!is_array($ids)) {
            $ids = array($ids);
        }

        foreach(array_chunk($ids, 1024) as $chunk )  {
            $this->_getResource()->updateHash($chunk, $hash);
        }

        return $this;
    }
}
