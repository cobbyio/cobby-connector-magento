<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

/**
 * Class Cobby_Connector_Helper_Systemcheck
 */

class Cobby_Connector_Helper_Systemcheck extends Mage_Core_Helper_Abstract
{
    const PHP_MIN_VERSION = "5.6";
    const OK = 0;
    const ERROR = 1;
    const EXCEPTION = -1;
    const MIN_MEMORY = 512;
    const MAINTENANCE_MODE = 'maintenance.flag';
    const URL = 'https://help.cobby.io';
    const VALUE = 'value';
    const CODE = 'code';
    const LINK = 'link';

    private $relevantIndexers = array(
        'catalog_category_product' => 'Category Products',
        'catalog_product_price' => 'Product Prices',
        'cataloginventory_stock' => 'Stock Status',
        'catalog_product_flat' => 'Product Flat Data',
        'catalog_category_flat' => 'Category Flat Data'
    );

    public function getReport()
    {
        $result = array(
            'phpversion' => $this->checkPhpVersion(),
            'memory' => $this->checkMemory(),
            'maintenance' => $this->checkMaintenanceMode(),
            'indexer' => $this->checkIndexerStatus(),
            'cobby_active' => $this->checkCobbyActive(),
            'cobby_version' => $this->checkCobbyVersion()
        );

        return $result;
    }

    public function checkMemory()
    {
        $value = $this->__('Memory ok');
        $code = self::OK;
        $link = '';

        try {
            $memory = ini_get('memory_limit');
            if ((int)$memory < self::MIN_MEMORY) {
                $code = self::ERROR;
                $value = $this->__('Memory is %sB, it has to be at least %sMB', $memory, self::MIN_MEMORY);
                $link = self::URL;
            }
        } catch (Exception $e) {
            $code = self::EXCEPTION;
            $value = $e->getMessage();
            $link = self::URL;
        }

        return array(self::VALUE => $value, self::CODE => $code, self::LINK => $link);
    }

    public function checkPhpVersion()
    {
        $value = $this->__('PHP version ok');
        $code = self::OK;
        $link = '';

        try {
            $version  = phpversion();
            if (version_compare($version, self::PHP_MIN_VERSION, '<')) {
                $$code = self::ERROR;
                $link = self::URL;
                $value = $this->__('PHP version is %s, it must be at least %s', $version, self::PHP_MIN_VERSION);
            }
        } catch (Exception $e) {
            $code = self::EXCEPTION;
            $value = $e->getMessage();
            $link = self::URL;
        }

        return array(self::VALUE => $value, self::CODE => $code, self::LINK => $link);
    }

    public function checkMaintenanceMode()
    {
        $value = $this->__('Is not active');
        $code = self::OK;
        $link = '';
        $maintenanceFlagFilePath = Mage::getBaseDir() . DS . self::MAINTENANCE_MODE;

        try {
            $maintenanceOn = file_exists($maintenanceFlagFilePath );
            if ($maintenanceOn) {
                $value = $this->__('Is active');
                $code = self::ERROR;
                $link = self::URL;
            }
        } catch (Exception $e) {
            $code = self::EXCEPTION;
            $value = $e->getMessage();
            $link = self::URL;
        }

        return array(self::VALUE => $value, self::CODE => $code, self::LINK => $link);
    }

    public function checkIndexerStatus()
    {
        $value = $this->__('Index is valid');
        $code = self::OK;
        $link = '';

        $runningIndexers = array();

        $indexerModel = Mage::getModel('cobby_connector/indexer_api');
        $indexers = $indexerModel->export();

        foreach ($indexers as $indexer) {
            if (key_exists($indexer['code'], $this->relevantIndexers) && $indexer['status'] == 'working') {
                $runningIndexers[] = $indexer['code'];
            }
        }

        if (!empty($runningIndexers)) {
            $value = $this->__('Indexing is in progress for: ') . implode('; ', $runningIndexers);
            $code = self::ERROR;
            $link = self::URL;
        }

        return array(self::VALUE => $value, self::CODE => $code, self::LINK => $link);
    }

    public function checkCobbyActive()
    {
        $value = $this->__('Cobby is active');
        $code = self::OK;
        $link = '';

        $active = Mage::getStoreConfigFlag('cobby/settings/active');

        if (!$active) {
            $value = $this->__('Cobby must be activated to work as expected');
            $code = self::ERROR;
            $link = self::URL;
        }

        return array(self::VALUE => $value, self::CODE => $code, self::LINK => $link);
    }

    public function checkCobbyVersion()
    {
        $code = self::OK;
        $value = $this->__('Your module version is synchronized');
        $link = '';

        $moduleVersion = Mage::getConfig()->getNode('modules/Cobby_Connector/version')->asArray();
        $cobbyVersion = Mage::getStoreConfig(Cobby_Connector_Helper_Settings::XML_PATH_COBBY_DBVERSION );

        if ($cobbyVersion != $moduleVersion) {
            $value = $this->__('Your module version is not synchronized, save config for synchronization');
            $code = self::ERROR;
            $link = self::URL;
        }

        return array(self::VALUE => $value, self::CODE => $code, self::LINK => $link);
    }

}
