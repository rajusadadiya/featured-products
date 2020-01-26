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
 * @category RSExtensions
 * @package  RS_FeaturedProducts
 * @author   Raju Sadadiya <rsadadiya@gmail.com>
 * @license  OSL 3.0
 * @link     http://www.rajusadadiya.com
 */

namespace RS\FeaturedProducts\Block;

use \RS\FeaturedProducts\Helper\Data;

/** 
 * Class FeaturedProduct
 * 
 * @category RSExtensions
 * @package  RS\FeaturedProducts\Block
 * @author   Raju Sadadiya <rsadadiya@gmail.com>
 * @license  OSL 3.0
 * @link     http://www.rajusadadiya.com
 */

class FeaturedProduct extends \RS\FeaturedProducts\Block\AbstractFeaturedProduct
{
    /**
     * Homepage configuration block name
     */
    const HOME_CONFIGURABLE_ITEM_BLOCK = "cms.index.toprenderers";

    /**
     * Product list page configuration block name
     */
    const LIST_CONFIGURABLE_ITEM_BLOCK = "product.list.toprenderers";

    /**
     * Product view page configuration block name
     */
    const PRODUCT_CONFIGURABLE_ITEM_BLOCK = "product.view.toprenderers";

    /**
     * Return Page name
     * 
     * @return string
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
        return $this->_fpHelper->getPageName($fullAction);
    } 
    
    /**
     * Return configurable product swatch
     * 
     * @param \Magento\Catalog\Model\Product $product 
     * 
     * @return string
     */
    public function getProductDetailsHtml(\Magento\Catalog\Model\Product $product)
    {
        $renderer = $this->getDetailsRenderer($product->getTypeId());
        if ($renderer) {
            $renderer->setProduct($product);
            return $renderer->toHtml();
        }
        return '';
    }   

    /**
     * Return product type block
     * 
     * @param string|null $type product type
     * 
     * @return bool|\Magento\Framework\View\Element\AbstractBlock
     */
    public function getDetailsRenderer($type = null)
    {
        if ($type === null) {
            $type = 'default';
        }
        $rendererList = $this->getDetailsRendererList();
        if ($rendererList) {
            return $rendererList->getRenderer($type, 'default');
        }
        return null;
    }
    
    /**
     * Return RednererList of blocks
     * 
     * @return \Magento\Framework\View\Element\RendererList
     */
    protected function getDetailsRendererList()
    {
        $configurableBlock = null;
        $page = $this->getPageName();
        
        if ($page == Data::HOMEPAGE_CODE) {
            $configurableBlock = self::HOME_CONFIGURABLE_ITEM_BLOCK;
        }
        if ($page == Data::CATEGORY_PAGE_CODE) {
            $configurableBlock = self::LIST_CONFIGURABLE_ITEM_BLOCK;
        }
        if ($page == Data::PRODUCT_PAGE_CODE) {
            $configurableBlock = self::PRODUCT_CONFIGURABLE_ITEM_BLOCK;
        }
        return $this->getDetailsRendererListName() ? $this->getLayout()->getBlock(
            $this->getDetailsRendererListName()
        ) : $this->getChildBlock($configurableBlock);
    }
}
