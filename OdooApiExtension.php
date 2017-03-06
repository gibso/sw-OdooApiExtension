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
            'Enlight_Controller_Dispatcher_ControllerPath_Api_AddressesSearch' => 'onGetAddressesSearchApiController',
            'Enlight_Controller_Dispatcher_ControllerPath_Api_CategoriesSearch' => 'onGetCategoriesSearchApiController',
            'Enlight_Controller_Dispatcher_ControllerPath_Api_ArticlesSearch' => 'onGetArticlesSearchApiController',
            'Enlight_Controller_Dispatcher_ControllerPath_Api_VariantsSearch' => 'onGetVariantsSearchApiController',
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
     * @return string
     */
    public function onGetAddressesSearchApiController()
    {
        return $this->getPath() . '/Controllers/Api/AddressesSearch.php';
    }

    /**
     * @return string
     */
    public function onGetCategoriesSearchApiController()
    {
        return $this->getPath() . '/Controllers/Api/CategoriesSearch.php';
    }

    /**
     * @return string
     */
    public function onGetArticlesSearchApiController()
    {
        return $this->getPath() . '/Controllers/Api/ArticlesSearch.php';
    }

    /**
     * @return string
     */
    public function onGetVariantsSearchApiController()
    {
        return $this->getPath() . '/Controllers/Api/VariantsSearch.php';
    }

    /**
     *
     */
    public function onEnlightControllerFrontStartDispatch()
    {
        $this->container->get('loader')->registerNamespace('Shopware\Components', $this->getPath() . '/Components/');
    }
}