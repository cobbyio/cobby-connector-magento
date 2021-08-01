<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

/**
 * Cobby sync resource model
 *
 */
class Cobby_Connector_Model_Resource_Indexer_Sync
{
    /**
     * @var Cobby_Connector_Helper_Cobbyapi
     */
    private $cobbyApi;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->cobbyApi = Mage::helper('cobby_connector/cobbyapi');
    }

    /**
     * Handler for "Reindex" action in the admin panel or console
     */
    public function reindexAll()
    {
        $this->cobbyApi->notifyCobbyService('indexer', 'resync', '');
    }
}