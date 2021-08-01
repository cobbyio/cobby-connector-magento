<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

class Cobby_Connector_Block_Adminhtml_Debug_Systemcheck extends Mage_Adminhtml_Block_Abstract
{
    private $helper;
    protected $phpVersion;
    protected $memory;
    protected $maintenance;
    protected $indexer;
    protected $cobbyActive;
    protected $cobbyVersion;

    protected $_template = 'cobby/system/config/debug/systemcheck.phtml';

    public function __construct()
    {
        parent::__construct();
        $this->helper = Mage::helper('cobby_connector/systemcheck');
        $this->setMemory();
        $this->setPhpVersion();
        $this->setMaintenanceMode();
        $this->setIndexerStatus();
        $this->setCobbyActive();
        $this->setCobbyVersion();
    }

    public function getMemory()
    {
        return $this->htmlBuilder($this->memory);
    }

    public function getPhpVersion()
    {
        return $this->htmlBuilder($this->phpVersion);
    }

    public function getMaintenanceMode()
    {
        return $this->htmlBuilder($this->maintenance);
    }

    public function getIndexerStatus()
    {
        return $this->htmlBuilder($this->indexer);
    }

    public function getCobbyActive()
    {
        return $this->htmlBuilder($this->cobbyActive);
    }

    /**
    * @return mixed
    */
    public function getCobbyVersion()
    {
        return $this->htmlBuilder($this->cobbyVersion);
    }

    public function getIcon($section)
    {
        $ret = '<img src="/skin/adminhtml/default/default/images/';
        $code = $section[Cobby_Connector_Helper_Systemcheck::CODE];

        switch ($code) {
            case Cobby_Connector_Helper_Systemcheck::OK:
                $ret .= 'fam_bullet_success.gif">';
                break;
            case Cobby_Connector_Helper_Systemcheck::ERROR:
                $ret .= 'error_msg_icon.gif">';
                break;
            case Cobby_Connector_Helper_Systemcheck::EXCEPTION:
                $ret .= 'fam_bullet_error.gif">';
                break;
        }

        return $ret;
    }

    private function htmlBuilder($transport)
    {
        $code = $transport[Cobby_Connector_Helper_Systemcheck::CODE];
        $value = $transport[Cobby_Connector_Helper_Systemcheck::VALUE];
        $link = $transport[Cobby_Connector_Helper_Systemcheck::LINK];
        $ret = '';

        switch ($code) {
            case Cobby_Connector_Helper_Systemcheck::OK:
                $ret = '<span class="ok">' . $this->__($value) . '</span>';
                break;
            case Cobby_Connector_Helper_Systemcheck::ERROR:
                $ret =  '<span class="error">' . $this->__($value) . '</span>';
                $ret .=  '<a target="_blank" href=' . $link . '><div class="field-tooltip"></div></a>';
                break;
            case Cobby_Connector_Helper_Systemcheck::EXCEPTION:
                $ret = '<span class="exception">' . $this->__($value) . '</span>';
                $ret .= '<a target="_blank" href=' . $link . '><div class="field-tooltip"></div></a>';
                break;
        }

        return $ret;
    }

    private function setMemory()
    {
        $this->memory = $this->helper->checkMemory();
    }

    private function setPhpVersion()
    {
        $this->phpVersion = $this->helper->checkPhpVersion();
    }



    private function setMaintenanceMode()
    {
        $this->maintenance = $this->helper->checkMaintenanceMode();
    }

    private function setIndexerStatus()
    {
        $this->indexer = $this->helper->checkIndexerStatus();
    }

    private function setCobbyActive()
    {
        $this->cobbyActive = $this->helper->checkCobbyActive();
    }

    private function setCobbyVersion()
    {
        $this->cobbyVersion = $this->helper->checkCobbyVersion();
    }
}
