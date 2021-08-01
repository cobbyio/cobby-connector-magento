<?php
/*
 * @copyright Copyright (c) 2021 mash2 GmbH & Co. KG. All rights reserved.
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0).
 */

class Cobby_Connector_Model_Core_Translate_Api  extends Mage_Api_Model_Resource_Abstract
{
    public function getTranslation($locale)
    {
        Mage::app()->getLocale()->setLocaleCode($locale);
        $translate= Mage::getModel('cobby_connector/core_translate')
            ->init('frontend', true);
        $result = $translate->getData();
        if(count($result)==0)
            return new stdClass();
        return $result;
    }

    public function getLocales()
    {
        $locales = array();
        $options = array();

        foreach (Mage::app()->getStores() as $store) {
            $locale = Mage::app()->getStore($store->getId())->getConfig('general/locale/code');
            if (!in_array($locale, $locales)) {
                $locales[] = $locale;
            }
        }

        foreach (Mage::app()->getLocale()->getOptionLocales() as $key => $localeInfo) {
            if (in_array($localeInfo['value'], $locales)) {
                $options[$localeInfo['value']] = $localeInfo['label'];
            }
        }

        return $options;
    }
}