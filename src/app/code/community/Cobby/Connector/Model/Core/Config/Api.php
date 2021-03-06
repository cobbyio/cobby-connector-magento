<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

/**
 * Config API
 *
 */
class Cobby_Connector_Model_Core_Config_Api extends Mage_Api_Model_Resource_Abstract
{

    /**
     * config paths use in cobby
     *
     * @var array
     */
    protected $_configPaths = array(
        'cobby/settings/overwrite_images',
        'cobby/settings/cobby_version',
        'cobby/settings/clear_cache',
        'web/unsecure/base_media_url',
        'cataloginventory/item_options/manage_stock',
        'cataloginventory/item_options/backorders',
        'cataloginventory/item_options/min_qty',
        Cobby_Connector_Helper_Settings::XML_PATH_COBBY_MANAGE_STOCK
    );

    private $settings;

    public function __construct()
    {
        $this->settings = Mage::helper('cobby_connector/settings');
    }

    /**
     * Retrieve cobby relevant configs
     *
     * @return array
     */
    public function export()
    {
        $result = array();
        $stores = Mage::app()->getStores(true);
        $adminUrl = Mage::getModel('adminhtml/url')->turnOffSecretKey()->getUrl('adminhtml');

        $isEE = Mage::helper('core')->isModuleEnabled('Enterprise_ImportExport');
        $magentoVersion = Mage::getVersion();

        foreach($stores as $store)
        {
            $baseUrl = $store->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK);
            if($store->getStoreId() == Mage_Catalog_Model_Abstract::DEFAULT_STORE_ID ) {
                $defaultGroup = Mage::app()->getWebsite(true)->getDefaultGroup();
                if ($defaultGroup) {
                    $defaultStore = $defaultGroup->getDefaultStore();
                    if ($defaultStore) {
                        $baseUrl = $defaultStore->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK);
                    }
                }
            }

            $storeConfigs = array(
                'web/unsecure/base_url' => $baseUrl,
                'cobby/settings/admin_url' => $adminUrl,
                'mage/core/enterprise' => $isEE,
                'mage/core/magento_version' => $magentoVersion,

            );
            foreach($this->_configPaths as $path)
            {
                $storeConfigs[$path] = (string)Mage::getStoreConfig($path, $store->getStoreId());
            }

            $result[$store->getStoreId().'|'] = $storeConfigs;
        }

        return $result;
    }

    public function active($data)
    {
        $value = 0;

        if($data['active'] == 'true') {
            $value = 1;
        }

        $this->settings->setCobbyActive($value);

        return $data;
    }
}