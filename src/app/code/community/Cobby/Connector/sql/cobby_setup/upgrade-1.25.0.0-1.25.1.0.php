<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer->startSetup();

$installer->getConnection()->addColumn(
    $installer->getTable('cobby_connector/queue'),
    'user_name',
    'varchar(255) null default null'
);

$installer->getConnection()->addColumn(
    $installer->getTable('cobby_connector/queue'),
    'context',
    'varchar(255) null default null'
);

$installer->endSetup();