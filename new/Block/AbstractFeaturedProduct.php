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
 * php version 7.0
 *
 * @category RSExtensions
 * @package  RS_FeaturedProducts
 * @author   Raju Sadadiya <rsadadiya@gmail.com>
 * @license  OSL 3.0
 * @link     http://www.rajusadadiya.com
 */

namespace RS\FeaturedProducts\Block;

use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Framework\Url\Helper\Data;
use RS\FeaturedProducts\Helper\Data as FeaturedProductHelper;

/**
 * Class AbstractFeaturedProduct
 *
 * @category RSExtensions
 * @package  RS\FeaturedProducts\Block
 * @author   Raju Sadadiya <rsadadiya@gmail.com>
 * @license  OSL 3.0
 * @link     http://www.rajusadadiya.com
 */

class AbstractFeaturedProduct extends AbstractProduct
{
    /**
     *Product visibility object
     *
     *@var \Magento\Catalog\Model\Product\Visibility
     */
    protected $catalogProductVisibility;

    /**
     *Product collection object
     *
     *@var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $productCollectionFactory;
    
    /**
     *Url Helper object
     *
     *@var \Magento\Framework\Url\Helper\Data
     */
    protected $urlHelper;

    /**
     *Featured products helper
     *
     *@var \RS\FeaturedProducts\Helper\Data
     */
    protected $fpHelper;
    
    /**
     *Default Constructor
     *
     *@param Context               $context                  Context Object
     *@param CollectionFactory     $productCollectionFactory Collection Object
     *@param Visibility            $catalogProductVisibility Visibility object
     *@param Data                  $urlHelper                Url helper object
     *@param FeaturedProductHelper $fpHelper                 Featured Product helper
     *@param array                 $data                     Arguments array
     */
    public function __construct(
        Context $context,
        CollectionFactory $productCollectionFactory,
        Visibility $catalogProductVisibility,
        Data $urlHelper,
        FeaturedProductHelper $fpHelper,
        array $data = []
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->catalogProductVisibility = $catalogProductVisibility;
        $this->urlHelper = $urlHelper;
        $this->fpHelper = $fpHelper;
        parent::__construct($context, $data);
    }
    
    /**
     *Return product collection
     *
     *@return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getProducts()
    {
        $storeId  = $this->_storeManager->getStore()->getId();
        $collectionSize = $this->fpHelper
            ->getItemLimit($this->getPageName()) > 0 ? $this->fpHelper
            ->getItemLimit($this->getPageName()) : 10;
        $collection = $this->productCollectionFactory->create()
            ->setStoreId($storeId);

        $collection->addAttributeToSelect("*")
            ->addAttributeToFilter('rs_is_featured', 1)
            ->addAttributeToSort(
                $this->fpHelper->getDefaultSort($this->getPageName()),
                $this->fpHelper->getDefaultSortOrder($this->getPageName())
            )
            ->addMinimalPrice()
            ->addFinalPrice()
            ->addTaxPercents()
            ->addUrlRewrite()
            ->setVisibility(
                $this->catalogProductVisibility->getVisibleInCatalogIds()
            );
        $collection->setPageSize($collectionSize)->setCurPage(1);
        $this->_eventManager->dispatch(
            'catalog_block_product_list_collection',
            ['collection' => $collection]
        );
        return $collection;
    }
    
    /**
     *Return add to cart form parameters
     *
     *@param \Magento\Catalog\Model\Product $product product object
     *
     *@return type
     */
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
    
    /**
     *Return Product collection
     *
     *@return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getLoadedProductCollection()
    {
        return $this->getProducts();
    }

    /**
     *Return collection limit
     *
     *@return int
     */
    public function getProductCount()
    {
        $limit = $this->getData("product_count");
        if (!$limit) {
            $limit = 10;
        }
        return $limit;
    }

    /**
     *Return Pagename
     *
     *@return string
     */
    public function getPageName()
    {
        $route = $this->getRequest()->getRouteName();
        $controllerName = $this->getRequest()->getControllerName();
        $action =  $this->getRequest()->getActionName();
        $fullAction = $route."/".$controllerName."/".$action;
        unset($route);
        unset($controllerName);
        unset($action);
        return $this->fpHelper->getPageName($fullAction);
    }

    /**
     *Return Image Dimensions
     *
     *@return array
     */
    public function getImageHightWidth()
    {
        $items = $this->getDefaultSliderItem();
        $dimensions = [];
        $dimensions["width"] = 1024 / $items;
        $height = $dimensions["width"] / $items;
        $dimensions["height"] = $dimensions["width"]+$height;
        return $dimensions;
    }
    
    /**
     *Return module is enable or not
     *
     *@return bool
     */
    public function isEnable()
    {
        return $this->fpHelper->isEnable($this->getPageName());
    }

    /**
     *Return Block Title
     *
     *@return String
     */
    public function getTitle()
    {
        return $this->fpHelper->getTitle($this->getPageName());
    }

    /**
     *Return Collection Limits
     *
     *@return int
     */
    public function getItemLimit()
    {
        return $this->fpHelper->getItemLimit($this->getPageName());
    }
    
    /**
     *Return bool value for price display
     *
     *@return bool
     */
    public function isShowPrice()
    {
        return $this->fpHelper->isShowPrice($this->getPageName());
    }

    /**
     *Return bool value for review display
     *
     *@return bool
     */
    public function isShowReview()
    {
        return $this->fpHelper->isShowReview($this->getPageName());
    }
    
    /**
     *Return bool value for addtocart display
     *
     *@return bool
     */
    public function isShowAddToCart()
    {
        return $this->fpHelper->isShowAddToCart($this->getPageName());
    }

    /**
     *Return bool value for addtowhishlist display
     *
     *@return bool
     */
    public function isShowAddToWishlist()
    {
        return $this->fpHelper->isShowAddToWishlist($this->getPageName());
    }

    /**
     *Return bool value for compare button display
     *
     *@return bool
     */
    public function isShowAddToCompare()
    {
        return $this->fpHelper->isShowAddToCompare($this->getPageName());
    }

    /**
     *Return Image Dimensions
     *
     *@return bool
     */
    public function isSliderEnable()
    {
        return $this->fpHelper->isSliderEnable($this->getPageName());
    }

    /**
     *Return default slider items
     *
     *@return bool
     */
    public function getDefaultSliderItem()
    {
        return $this->fpHelper->getDefaultSliderItem($this->getPageName());
    }

    /**
     *Return enable/disable slider
     *
     *@return bool
     */
    public function enableAutoSlide()
    {
        return $this->fpHelper->enableAutoSlide($this->getPageName());
    }

    /**
     *Return enable/disable Next/Prev button
     *
     *@return bool
     */
    public function isShowNextPrev()
    {
        return $this->fpHelper->isShowNextPrev($this->getPageName());
    }

    /**
     *Return enable/disable navigation dots
     *
     *@return bool
     */
    public function isShowNavigation()
    {
        return $this->fpHelper->isShowNavigation($this->getPageName());
    }

    /**
     *Return Image Dimensions
     *
     *@return bool
     */
    public function getSliderSpeed()
    {
        return $this->fpHelper->getSliderSpeed($this->getPageName());
    }

    /**
     *Return Magento version information
     *
     *@return string
     */
    public function getMagentoVersion()
    {
        return $this->fpHelper->getMagentoVersion();
    }
}
