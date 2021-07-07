<?php

/**
 * cobby settings helper
 */
class Cobby_Connector_Helper_Settings extends Mage_Core_Helper_Abstract
{
    const XML_PATH_PRODUCT_CATEGORY_POSITION            = 'cobby/settings/product_category_position';
    const XML_PATH_LICENSE_KEY                          = 'cobby/settings/license_key';
    const XML_PATH_COBBY_VERSION                        = 'cobby/settings/cobby_version';
    const XML_PATH_COBBY_DBVERSION                      = 'cobby/settings/cobby_dbversion';
    const XML_PATH_COBBY_MANAGE_STOCK                   = 'cobby/stock/manage';
    const XML_PATH_COBBY_PRODUCT_QUANTITY               = 'cobby/stock/quantity';
    const XML_PATH_COBBY_STOCK_AVAILABILITY             = 'cobby/stock/availability';
    const XML_PATH_COBBY_SETTINGS_ACTIVE                = 'cobby/settings/active';
    const XML_PATH_COBBY_URL                            = 'cobby/settings/base_url';
    const MANAGE_STOCK_ENABLED                          = 0;
    const MANAGE_STOCK_READONLY                         = 1;
    const MANAGE_STOCK_DISABLED                         = 2;

    /**
     * get default product category position
     *
     * @return int
     */
    public function getProductCategoryPosition()
    {
        return (int)Mage::getStoreConfig(self::XML_PATH_PRODUCT_CATEGORY_POSITION);
    }

    /**
     *  Get current license Key
     *
     * @return string
     */
    public function getLicenseKey()
    {
        $licenseKey = Mage::getStoreConfig(self::XML_PATH_LICENSE_KEY);
        return $licenseKey;
    }

    /**
     * @param string $licenseKey
     */
    public function setLicenseKey($licenseKey)
    {
        Mage::getModel('core/config')
            ->saveConfig(self::XML_PATH_LICENSE_KEY, $licenseKey);
    }

    /**
     * Get stock management setting
     *
     * @return int
     */
    public function getManageStock()
    {
        return Mage::getStoreConfig(self::XML_PATH_COBBY_MANAGE_STOCK);
    }

    /**
     * Get default quantity
     *
     * @return int
     */
    public function getDefaultQuantity()
    {
        return Mage::getStoreConfig(self::XML_PATH_COBBY_PRODUCT_QUANTITY);
    }

    /**
     * Get default availability
     *
     * @return int
     */
    public function getDefaultAvailability()
    {
        return Mage::getStoreConfig(self::XML_PATH_COBBY_STOCK_AVAILABILITY);
    }

    /**
     * Get admin base url
     *
     * @return string
     */
    public function getDefaultBaseUrl()
    {
        return Mage::app()
            ->getStore(Mage_Catalog_Model_Abstract::DEFAULT_STORE_ID)
            ->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB, true);
    }

    /**
     * Get current cobby version
     *
     * @return string
     */
    public function getCobbyVersion()
    {
        return Mage::getStoreConfig(self::XML_PATH_COBBY_VERSION);
    }

    public function setCobbyVersion($url)
    {
        Mage::getConfig()->saveConfig(self::XML_PATH_COBBY_DBVERSION, $url, 'default', 0);
    }

    public function isCobbyEnabled()
    {
        $enabled = $this->getCobbyActive();
        $license = $this->getLicenseKey();

        if ($enabled && isset($license)) {
            return true;
        } else {
            return false;
        }
    }

    public function getCobbyUrl()
    {
        return Mage::getStoreConfig(self::XML_PATH_COBBY_URL);
    }

    public function setCobbyUrl($url)
    {
        Mage::getConfig()->saveConfig(self::XML_PATH_COBBY_URL, $url);
    }

    public function setCobbyActive($value)
    {
        Mage::getConfig()->saveConfig(self::XML_PATH_COBBY_SETTINGS_ACTIVE, $value);

        return true;
    }

    public function getCobbyActive()
    {
        $status = Mage::getStoreConfig(self::XML_PATH_COBBY_SETTINGS_ACTIVE);

        if($status === "0") {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Retrieve rename images
     *
     * @return string
     */
    public function getOverwriteImages()
    {
        return Mage::getStoreConfigFlag('cobby/settings/overwrite_images');
    }
}
