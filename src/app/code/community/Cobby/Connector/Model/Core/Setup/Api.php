<?php
/**
 * License API
 * exporting and importing the licenceKey
 *
 */
class Cobby_Connector_Model_Core_Setup_Api extends Mage_Api_Model_Resource_Abstract
{
    private $helper;

    public function __construct()
    {
        $this->helper = Mage::helper('cobby_connector/settings');
    }

    /**
     * returns in a array License Key, Cobby Version, Magento Version , if Cobby is active and the used RAM
     *
     * @return array
     */
    public function export()
    {
        $result = array();
        $licenseKey = $this->helper->getLicenseKey();
        $cobbyVersion = $this->helper->getCobbyVersion();
        $magentoVersion = Mage::getVersion();
        $cobbyActive = $this->helper->getCobbyActive();

        try {
            $memory = ini_get('memory_limit');
        }
        catch(Exception $e){
            $memory = $e->getMessage();
        }

        $result[] = array(
            'license_key' => $licenseKey,
            'cobby_version' => $cobbyVersion,
            'magento_version' => $magentoVersion,
            'cobby_active' => $cobbyActive,
            'memory' => $memory);

        return $result;
    }

    /**
     * set License key
     * @param $licenseKey
     * @param $clearConfigCache
     * @return array
     */
    public function import($licenseKey, $clearConfigCache)
    {
        $this->helper->setLicenseKey($licenseKey);

        if($clearConfigCache){
            Mage::app()->getCacheInstance()->cleanType('config');
        }
        return array('result' => true);
    }
}
