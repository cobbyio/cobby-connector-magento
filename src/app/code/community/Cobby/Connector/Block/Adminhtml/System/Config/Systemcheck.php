<?php

class Cobby_Connector_Block_Adminhtml_System_Config_Systemcheck extends Mage_Adminhtml_Block_System_Config_Form_Fieldset
{
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        return $this->getLayout()->createBlock('cobby_connector/adminhtml_debug_systemcheck')->toHtml();
    }
}