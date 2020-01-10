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

class FeaturedProduct extends \RS\FeaturedProducts\Block\AbstractFeaturedProduct 
{
    const CONFIGURABLE_ITEM_BLOCK = "cms.index.toprenderers";

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

    public function getProductDetailsHtml(\Magento\Catalog\Model\Product $product)
    {
        $renderer = $this->getDetailsRenderer($product->getTypeId());
        if ($renderer) {
            $renderer->setProduct($product);
            return $renderer->toHtml();
        }
        return '';
    }   

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

    protected function getDetailsRendererList()
    {
        return $this->getDetailsRendererListName() ? $this->getLayout()->getBlock(
            $this->getDetailsRendererListName()
        ) : $this->getChildBlock(self::CONFIGURABLE_ITEM_BLOCK);
    }
}
