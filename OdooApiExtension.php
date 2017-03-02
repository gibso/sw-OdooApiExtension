<?php

namespace OdooApiExtension;

use Shopware\Components\Plugin;

/**
 * Class OdooApiExtension
 */
class OdooApiExtension extends Plugin
{
    /**
     * @inheritdoc
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Dispatcher_ControllerPath_Api_ShopsSearch' => 'onGetShopsSearchApiController',
            'Enlight_Controller_Dispatcher_ControllerPath_Api_CustomerGroupsSearch' => 'onGetCustomerGroupsSearchApiController',
            'Enlight_Controller_Dispatcher_ControllerPath_Api_CustomersSearch' => 'onGetCustomersSearchApiController',
            'Enlight_Controller_Dispatcher_ControllerPath_Api_CustomersExtended' => 'onGetCustomersExtendedApiController',
            'Enlight_Controller_Front_StartDispatch' => 'onEnlightControllerFrontStartDispatch'
        ];
    }

    /**
     * @return string
     */
    public function onGetShopsSearchApiController()
    {
        return $this->getPath() . '/Controllers/Api/ShopsSearch.php';
    }

    /**
     * @return string
     */
    public function onGetCustomerGroupsSearchApiController()
    {
        return $this->getPath() . '/Controllers/Api/CustomerGroupsSearch.php';
    }

    /**
     * @return string
     */
    public function onGetCustomersSearchApiController()
    {
        return $this->getPath() . '/Controllers/Api/CustomersSearch.php';
    }

    /**
     * @return string
     */
    public function onGetCustomersExtendedApiController()
    {
        return $this->getPath() . '/Controllers/Api/CustomersExtended.php';
    }

    /**
     *
     */
    public function onEnlightControllerFrontStartDispatch()
    {
        $this->container->get('loader')->registerNamespace('Shopware\Components', $this->getPath() . '/Components/');
    }
}