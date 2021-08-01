<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

class Cobby_Connector_Model_Admin_Session extends Mage_Admin_Model_Session
{
    protected function _getRequestUri($request = null)
    {
        return null;
    }
}
