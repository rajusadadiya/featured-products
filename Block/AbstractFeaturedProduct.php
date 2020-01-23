<?php
/**
 * Raju Sadadiya
 *
 * NOTICE OF LICENSE
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    RS
 * @package     RS_FeaturedProducts
 */
namespace RS\FeaturedProducts\Block;

use \RS\FeaturedProducts\Helper\Data;

class AbstractFeaturedProduct extends \Magento\Catalog\Block\Product\AbstractProduct 
{
    protected $_catalogProductVisibility;

    protected $_productCollectionFactory;

    protected $_categoryFactory;

    protected $urlHelper;

    protected $_fpHelper;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Catalog\Model\Product\Visibility $catalogProductVisibility,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        \RS\FeaturedProducts\Helper\Data $fpHelper,
        array $data = []
    ) {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_catalogProductVisibility = $catalogProductVisibility;
        $this->urlHelper = $urlHelper;
        $this->_fpHelper = $fpHelper;
        parent::__construct($context, $data);
    }

    public function getProducts() {
        
        $storeId  = $this->_storeManager->getStore()->getId();
        $collectionSize = $this->_fpHelper->getItemLimit($this->getPageName()) > 0 ? $this->_fpHelper->getItemLimit($this->getPageName()) : 10;
        $collection = $this->_productCollectionFactory->create()->setStoreId($storeId);

        $collection->addAttributeToSelect("*")
            ->addAttributeToFilter('rs_is_featured', 1)
            ->addAttributeToSort($this->_fpHelper->getDefaultSort($this->getPageName()),$this->_fpHelper->getDefaultSortOrder($this->getPageName()))
            ->addMinimalPrice()
            ->addFinalPrice()
            ->addTaxPercents()
            ->addUrlRewrite()
            ->setVisibility($this->_catalogProductVisibility->getVisibleInCatalogIds());
        $collection->setPageSize($collectionSize)->setCurPage(1);
        $this->_eventManager->dispatch(
            'catalog_block_product_list_collection',
            ['collection' => $collection]
        );  
        return $collection;
    }

    public function getAddToCartPostParams(\Magento\Catalog\Model\Product $product)
    {
        $url = $this->getAddToCartUrl($product);
        return [
            'action' => $url,
            'data' => [
                'product' => $product->getEntityId(),
                \Magento\Framework\App\Action\Action::PARAM_NAME_URL_ENCODED =>
                    $this->urlHelper->getEncodedUrl($url),
            ]
        ];
    }

    public function getLoadedProductCollection() {
        return $this->getProducts();
    }

    public function getProductCount() {
        $limit = $this->getData("product_count");
        if(!$limit)
            $limit = 10;
        return $limit;
    }

    public function getPageName()
    {
        $route = $this->getRequest()->getRouteName();
        $controllerName = $this->getRequest()->getControllerName();
        $action =  $this->getRequest()->getActionName();
        $fullAction = $route."/".$controllerName."/".$action;
        unset($route);
        unset($controllerName);
        unset($action);
        return $this->_fpHelper->getPageName($fullAction);
    }

    public function getImageHightWidth()
    {
        $items = $this->getDefaultSliderItem();
        $dimensions = [];
        $dimensions["width"] = 1024 / $items;
        $height = $dimensions["width"] / $items;
        $dimensions["height"] = $dimensions["width"]+$height;
        return $dimensions;
    }
    
    public function isEnable()
    {
        return $this->_fpHelper->isEnable($this->getPageName());
    }

    public function getTitle()
    {
        return $this->_fpHelper->getTitle($this->getPageName());
    }

    public function getItemLimit()
    {
        return $this->_fpHelper->getItemLimit($this->getPageName());
    }

    public function isShowPrice()
    {
        return $this->_fpHelper->isShowPrice($this->getPageName());
    }

    public function isShowReview()
    {
        return $this->_fpHelper->isShowReview($this->getPageName());
    }

    public function isShowAddToCart()
    {
        return $this->_fpHelper->isShowAddToCart($this->getPageName());
    }

    public function isShowAddToWishlist()
    {
        return $this->_fpHelper->isShowAddToWishlist($this->getPageName());
    }

    public function isShowAddToCompare()
    {
        return $this->_fpHelper->isShowAddToCompare($this->getPageName());
    }

    public function isSliderEnable()
    {
        return $this->_fpHelper->isSliderEnable($this->getPageName());
    }

    public function getDefaultSliderItem()
    {
        return $this->_fpHelper->getDefaultSliderItem($this->getPageName());
    }

    public function enableAutoSlide()
    {
        return $this->_fpHelper->enableAutoSlide($this->getPageName());
    }

    public function isShowNextPrev()
    {
        return $this->_fpHelper->isShowNextPrev($this->getPageName());
    }

    public function isShowNavigation()
    {
        return $this->_fpHelper->isShowNavigation($this->getPageName());
    }

    public function getSliderSpeed()
    {
        return $this->_fpHelper->getSliderSpeed($this->getPageName());
    }
}
