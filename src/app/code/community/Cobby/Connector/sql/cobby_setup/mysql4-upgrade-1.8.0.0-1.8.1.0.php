<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

/** @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->run("
CREATE TABLE IF NOT EXISTS `{$installer->getTable('cobby_connector/queue')}` (
  `queue_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `object_ids` text NOT NULL,
  `object_entity` varchar(255) NOT NULL,
  `object_action` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`queue_id`))
  ENGINE=InnoDB DEFAULT CHARSET=utf8 ;
");

$installer->endSetup();
