<?php

class Cobby_Connector_Helper_Cobbyapi extends Mage_Core_Helper_Abstract
{
    /**
     * cobby service url
     */
    const COBBY_API = 'https://api.magento.cobby.io/';

    /**
     * @var Cobby_Connector_Helper_Settings
     */
    private $settings;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->settings = Mage::helper('cobby_connector/settings');
    }

    /**
     * Create a cobby request with required items
     *
     * @return array
     */
    private function createCobbyRequest()
    {
        $result = array();
        $result['LicenseKey']   = $this->settings->getLicenseKey();
        $result['ShopUrl']      = $this->settings->getDefaultBaseUrl();
        $result['CobbyVersion'] = $this->settings->getCobbyVersion();

        return $result;
    }

    /**
     * get rest client
     *
     * @return Zend_Rest_Client
     */
    private function getClient()
    {
        return new Zend_Rest_Client(self::COBBY_API);
    }

    /**
     *
     * Performs an HTTP POST request to cobby service
     *
     * @param $method
     * @param null $data
     * @return mixed
     * @throws Exception
     */
    public function restPost($method, $data = null)
    {
        $client = $this->getClient();
        $httpClient = $client->getHttpClient();
        $httpClient->setConfig(array('timeout' => 60));
        $client->setHttpClient($httpClient);

        $response = $client->restPost('/' . $method, $data);
        if ($response->getStatus() != 200 && $response->getStatus() != 201) {
            $errorRestResultAsObject = Zend_Json::decode($response->getBody(), Zend_Json::TYPE_OBJECT);
            throw new Exception($errorRestResultAsObject->message);
        }
        $restResultAsObject = Zend_Json::decode($response->getBody(), Zend_Json::TYPE_OBJECT);

        return $restResultAsObject;
    }


    /**
     * Notify cobby about magento changes
     *
     * @param $objectType
     * @param $method
     * @param $objectIds
     * @throws Exception
     */
    public function notifyCobbyService($objectType, $method, $objectIds)
    {
        $request = $this->createCobbyRequest();
        if ($request['LicenseKey'] != '') {
            $request['ObjectType'] = $objectType;
            $request['ObjectId'] = $objectIds;
            $request['Method'] = $method;

            try {
                $this->restPost('notify', $request);
            } catch (Exception $e) { // Zend_Http_Client_Adapter_Exception
                if ($e->getCode() != 1000) { //Timeout
//                    throw $e; //TODO: throw
                }
            }
        }
    }
}
