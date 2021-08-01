<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

/**
 * Cobby export entity product type simple configurable
 *
 */
class Cobby_Connector_Model_Import_Entity_Product_Type_Configurable
    extends Mage_ImportExport_Model_Import_Entity_Product_Type_Configurable
{

    /**
     * Prepare attributes values for save:
     *
     * @param array $rowData
     * @return array
     */
    public function prepareAttributesForSave(array $rowData, $withDefaultValue = true)
    {
        $result = array();

        foreach ($this->_getProductAttributes($rowData) as $attrCode => $attrParams) {
            if (!$attrParams['is_static']) {
                if (isset($rowData[$attrCode]) && strlen($rowData[$attrCode])) {
                    $result[$attrCode] = $rowData[$attrCode];
                } elseif (array_key_exists($attrCode, $rowData)) {
                    if ( !$this->isSkuNew($rowData) || $rowData[$attrCode] != "" || $attrCode == 'url_key' )
                    {
                        $result[$attrCode] = $rowData[$attrCode];
                    }
                } elseif (null !== $attrParams['default_value'] && isset($rowData['sku'])) {
                    if ($this->isSkuNew($rowData)) {
                        $result[$attrCode] = $attrParams['default_value'];
                    }
                }
            }
        }
        return $result;
    }

    /**
     * check if sku isset and exists
     *
     * @param array $rowData
     * @return bool
     */
    protected function isSkuNew(array $rowData)
    {
        if (isset($rowData['sku']) && $rowData['sku'] != '') {
            $sku =  $rowData['sku'];
            $oldSkus = $this->_entityModel->getOldSku();
            return !isset($oldSkus[$sku]);
        };
        return false;
    }
}
