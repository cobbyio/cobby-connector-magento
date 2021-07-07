<?php
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