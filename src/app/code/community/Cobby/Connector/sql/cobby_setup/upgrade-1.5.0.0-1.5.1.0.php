<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer->startSetup();
$configDataTable = $installer->getTable('core/config_data');
$conn = $installer->getConnection();

$select = $conn->select()
    ->from($configDataTable)
    ->where('path IN (?)',
        array(
            'cobby/settings/api_key',
            'cobby/htaccess/password'
        )
    );

$settings = $conn->fetchAll($select);
foreach ($settings as $setting) {
    if(!empty($setting['value'])){
        $encrypted =  Mage::helper('core')->encrypt($setting['value']);
        $installer->setConfigData('cobby/settings/api_key', $encrypted);
    }
}
$installer->endSetup();