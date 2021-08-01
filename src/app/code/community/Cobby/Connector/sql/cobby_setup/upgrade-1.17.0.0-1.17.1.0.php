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
    ->from($installer->getTable('core/config_data'), 'COUNT(*)')
    ->where('path=?', 'cobby/settings/license_key');

$count =  (int)$conn->fetchOne($select);

if($count > 0){
    $installer->setConfigData('cobby/settings/choose_user', 1);
}
$installer->endSetup();