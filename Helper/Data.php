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
namespace RS\FeaturedProducts\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
	const HOMEPAGE = "cms/index/index";

    const CATEGORY_PAGE = "catalog/category/view";

    const PRODUCT_PAGE = "catalog/product/view";

    const HOMEPAGE_CODE = "homepage";
    
    const CATEGORY_PAGE_CODE = "category_page";
    
    const PRODUCT_PAGE_CODE = "product_page";

	const SECTION = "featuredproduct";

	const GENERAL = "general";

	const ACTIVE = "active";

	const TITLE = "title";

	const LIMIT = "item_limit";

	const PRICE = "enable_price";

	const REVIEW = "enable_review";

	const ADDTOCART = "enable_addtocart";

	const ADDTOWISHLIST = "enable_addtowishlist";

	const ADDTOCOMPARE = "enable_addtocompare";

	const SLIDER_ACTIVE = "slider_active";

	const AUTO_SLIDER = "auto_slider";

	const SLIDER_SPEED = "slider_speed";

	const DEFAULT_ITEM = "default_items";

	const NEXT_PREV = "next_prev";

	const NAV = "nav";

    public function __construct(\Magento\Framework\App\Helper\Context $context)
    {
        parent::__construct($context);
    }

    /* Configuration settings */
    public function getConfig($path)
    {
    	$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORES;
    	return $this->scopeConfig->getValue($path, $storeScope);
    }

    public function isEnable($page)
    {
    	if($this->getConfig(self::SECTION."/".self::GENERAL."/".self::ACTIVE))
    	{
    		return $this->getConfig(self::SECTION."/".$page."/".self::ACTIVE);
    	}
    	return false;
    }

    public function getTitle($page)
    {
    	return $this->getConfig(self::SECTION."/".$page."/".self::TITLE) !=  "" ? $this->getConfig(self::SECTION."/".$page."/".self::TITLE) : $this->getConfig(self::SECTION."/".self::GENERAL."/".self::TITLE);
    }

    public function getItemLimit($page)
    {
    	return $this->getConfig(self::SECTION."/".$page."/".self::LIMIT) !=  "" ? $this->getConfig(self::SECTION."/".$page."/".self::LIMIT) : $this->getConfig(self::SECTION."/".self::GENERAL."/".self::LIMIT);
    }
    
    public function isShowPrice($page)
    {
    	return $this->getConfig(self::SECTION."/".$page."/".self::PRICE);
    }

    public function isShowReview($page)
    {
    	return $this->getConfig(self::SECTION."/".$page."/".self::REVIEW);
    }

    public function isShowAddToCart($page)
    {
    	return $this->getConfig(self::SECTION."/".$page."/".self::ADDTOCART);
    }

    public function isShowAddToWishlist($page)
    {
    	return $this->getConfig(self::SECTION."/".$page."/".self::ADDTOWISHLIST);
    }

    public function isShowAddToCompare($page)
    {
    	return $this->getConfig(self::SECTION."/".$page."/".self::ADDTOCOMPARE);
    }

    public function isSliderEnable($page)
    {
    	return $this->getConfig(self::SECTION."/".$page."/".self::SLIDER_ACTIVE);
    }

    public function enableAutoSlide($page)
    {
    	return $this->getConfig(self::SECTION."/".$page."/".self::AUTO_SLIDER);
    }

    public function isShowNextPrev($page)
    {
    	return $this->getConfig(self::SECTION."/".$page."/".self::NEXT_PREV);
    }

    public function isShowNavigation($page)
    {
    	return $this->getConfig(self::SECTION."/".$page."/".self::NAV);
    }

    public function getSliderSpeed($page)
    {
    	return $this->getConfig(self::SECTION."/".$page."/".self::SLIDER_SPEED);
    }

    public function getDefaultSliderItem($page)
    {
    	return $this->getConfig(self::SECTION."/".$page."/".self::DEFAULT_ITEM);
    }

	public function getPageName($action)
	{
		if($action == self::HOMEPAGE)
		{
			return self::HOMEPAGE_CODE;
		}
		else if($action == self::CATEGORY_PAGE)
		{
			return self::CATEGORY_PAGE_CODE;
		}
		else if($action == self::PRODUCT_PAGE)
		{
			return self::PRODUCT_PAGE_CODE;
		}
		return false;
	}
}