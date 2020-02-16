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

namespace RS\FeaturedProducts\Helper;

/**
 * Class Data
 *
 * @category RSExtensions
 * @package  RS\FeaturedProducts\Helper
 * @author   Raju Sadadiya <rsadadiya@gmail.com>
 * @license  OSL 3.0
 * @link     http://www.rajusadadiya.com
 */

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * Homepage action
     */
    const HOMEPAGE = "cms/index/index";

    /**
     * Category page action
     */
    const CATEGORY_PAGE = "catalog/category/view";

    /**
     * Productpage action
     */
    const PRODUCT_PAGE = "catalog/product/view";

    /**
     * Homepage code
     */
    const HOMEPAGE_CODE = "homepage";
    
    /**
     * Category page code
     */
    const CATEGORY_PAGE_CODE = "category_page";
    
    /**
     * Product page code
     */
    const PRODUCT_PAGE_CODE = "product_page";

    /**
     * Featured Product system config section
     */
    const SECTION = "featuredproduct";

    /**
     * Config general tab
     */
    const GENERAL = "general";

    /**
     * Active Field
     */
    const ACTIVE = "active";

    /**
     * Title Field
     */
    const TITLE = "title";
    
    /**
     * Deafault Sort Field
     */
    const DEFAULT_SORT = "sort_by";

    /**
     * Default Sort order Field
     */
    const DEFAULT_SORT_ORDER = "sort_order";

    /**
     * Collection Limit Field
     */
    const LIMIT = "item_limit";

    /**
     * Enable Price Field
     */
    const PRICE = "enable_price";

    /**
     * Enable review Field
     */
    const REVIEW = "enable_review";

    /**
     * Enable Add To Card  Field
     */
    const ADDTOCART = "enable_addtocart";

    /**
     * Enable Add to whish Field
     */
    const ADDTOWISHLIST = "enable_addtowishlist";

    /**
     * Enable Add to compare Field
     */
    const ADDTOCOMPARE = "enable_addtocompare";

    /**
     * Active slider Field
     */
    const SLIDER_ACTIVE = "slider_active";

    /**
     * Active autoslider Field
     */
    const AUTO_SLIDER = "auto_slider";

    /**
     * SLider Speed Field
     */
    const SLIDER_SPEED = "slider_speed";

    /**
     * Default slider item Field
     */
    const DEFAULT_ITEM = "default_items";

    /**
     * Active next/prev Field
     */
    const NEXT_PREV = "next_prev";

    /**
     * Active navigation dots Field
     */
    const NAV = "nav";

    /**
     * MagentoMetaData object
     *
     * @var \Magento\Framework\App\ProductMetadataInterface
     */
    public $productMetadata;

    /**
     * Default Constructor
     *
     * @param \Magento\Framework\App\Helper\Context $context Context object
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\ProductMetadataInterface $productMetadata
    ) {
        parent::__construct($context);
        $this->productMetadata = $productMetadata;
    }

    /**
     * Return config value
     *
     * @param string $path config path
     *
     * @return mixed
     */
    public function getConfig($path)
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
        return $this->scopeConfig->getValue($path, $storeScope);
    }
    
    /**
     * Return config path
     *
     * @param string $path config path
     *
     * @return string
     */
    public function getConfigPath($path)
    {
        return self::SECTION."/".$path;
    }

    /**
     * Return IsEnable specific featured product block
     *
     * @param string $page Pagename
     *
     * @return boolean
     */
    public function isEnable($page)
    {
        $path = $this->getConfigPath(self::GENERAL."/".self::ACTIVE);
        if ($this->getConfig($path)) {
            return $this->getConfig(self::SECTION."/".$page."/".self::ACTIVE);
        }
        return false;
    }
    
    /**
     * Return Title featured product block
     *
     * @param string $page Pagename
     *
     * @return string
     */
    public function getTitle($page)
    {
        $pageTitlePath = $this->getConfigPath($page."/".self::TITLE);
        $defaultTitlePath = $this->getConfigPath(self::GENERAL."/".self::TITLE);
        $pageTitle = $this->getConfig($pageTitlePath);
        $defaultTitle = $this->getConfig($defaultTitlePath);
        return $pageTitle !=  "" ? $pageTitle : $defaultTitle;
    }
    
    /**
     * Return Collection  limits
     *
     * @param string $page Pagename
     *
     * @return int
     */
    public function getItemLimit($page)
    {
        $pageLimitPath = $this->getConfigPath($page."/".self::LIMIT);
        $defaultLimitPath = $this->getConfigPath(self::GENERAL."/".self::LIMIT);
        $pageLimit = $this->getConfig($pageLimitPath);
        $defaultLimit = $this->getConfig($defaultLimitPath);
        return $pageLimit !=  "" ? $pageLimit : $defaultLimit;
    }

    /**
     * Return Default sort options
     *
     * @param string $page Pagename
     *
     * @return string
     */
    public function getDefaultSort($page)
    {
        return $this->getConfig(self::SECTION."/".$page."/".self::DEFAULT_SORT);
    }

    /**
     * Return Default sort order options
     *
     * @param string $page Pagename
     *
     * @return string
     */
    public function getDefaultSortOrder($page)
    {
        $sortOrder = $this->getConfigPath($page."/".self::DEFAULT_SORT_ORDER);
        return $this->getConfig($sortOrder);
    }

    /**
     * Return price enable/disable
     *
     * @param string $page Pagename
     *
     * @return bool
     */
    public function isShowPrice($page)
    {
        return $this->getConfig(self::SECTION."/".$page."/".self::PRICE);
    }

    /**
     * Return review enable/disable
     *
     * @param string $page Pagename
     *
     * @return bool
     */
    public function isShowReview($page)
    {
        return $this->getConfig(self::SECTION."/".$page."/".self::REVIEW);
    }
    
    /**
     * Return Addtocart button enable/disable
     *
     * @param string $page Pagename
     *
     * @return bool
     */
    public function isShowAddToCart($page)
    {
        return $this->getConfig(self::SECTION."/".$page."/".self::ADDTOCART);
    }
    
    /**
     * Return Addtowishlist button enable/disable
     *
     * @param string $page Pagename
     *
     * @return bool
     */
    public function isShowAddToWishlist($page)
    {
        return $this->getConfig(self::SECTION."/".$page."/".self::ADDTOWISHLIST);
    }

    /**
     * Return AddtoCompare button enable/disable
     *
     * @param string $page Pagename
     *
     * @return bool
     */
    public function isShowAddToCompare($page)
    {
        return $this->getConfig(self::SECTION."/".$page."/".self::ADDTOCOMPARE);
    }

    /**
     * Return slider enable/disable
     *
     * @param string $page Pagename
     *
     * @return bool
     */
    public function isSliderEnable($page)
    {
        return $this->getConfig(self::SECTION."/".$page."/".self::SLIDER_ACTIVE);
    }

    /**
     * Return Autoslider enable/disable
     *
     * @param string $page Pagename
     *
     * @return bool
     */
    public function enableAutoSlide($page)
    {
        return $this->getConfig(self::SECTION."/".$page."/".self::AUTO_SLIDER);
    }

    /**
     * Return next/prev button enable/disable
     *
     * @param string $page Pagename
     *
     * @return bool
     */
    public function isShowNextPrev($page)
    {
        return $this->getConfig(self::SECTION."/".$page."/".self::NEXT_PREV);
    }

    /**
     * Return Navigation dots button enable/disable
     *
     * @param string $page Pagename
     *
     * @return bool
     */
    public function isShowNavigation($page)
    {
        return $this->getConfig(self::SECTION."/".$page."/".self::NAV);
    }

    /**
     * Return slider speed
     *
     * @param string $page Pagename
     *
     * @return int
     */
    public function getSliderSpeed($page)
    {
        return $this->getConfig(self::SECTION."/".$page."/".self::SLIDER_SPEED);
    }
    
    /**
     * Return slider item
     *
     * @param string $page Pagename
     *
     * @return int
     */
    public function getDefaultSliderItem($page)
    {
        return $this->getConfig(self::SECTION."/".$page."/".self::DEFAULT_ITEM);
    }

    /**
     * Return Pagename
     *
     * @param string $action Pageaction
     *
     * @return string
     */
    public function getPageName($action)
    {
        if ($action == self::HOMEPAGE) {
            return self::HOMEPAGE_CODE;
        } else if ($action == self::CATEGORY_PAGE) {
            return self::CATEGORY_PAGE_CODE;
        } else if ($action == self::PRODUCT_PAGE) {
            return self::PRODUCT_PAGE_CODE;
        }
        return false;
    }

    /**
     * Return Magento version
     *
     * @return string
     */
    public function getMagentoVersion()
    {
        return $this->productMetadata->getVersion();
    }
}
