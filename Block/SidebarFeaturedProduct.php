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

use RS\FeaturedProducts\Block\AbstractFeaturedProduct;

/** 
 * Class SidebarFeaturedProduct
 * 
 * @category RSExtensions
 * @package  RS\FeaturedProducts\Block
 * @author   Raju Sadadiya <rsadadiya@gmail.com>
 * @license  OSL 3.0
 * @link     http://www.rajusadadiya.com
 */

class SidebarFeaturedProduct extends AbstractFeaturedProduct
{
    /**
     * Return Page name
     * 
     * @return string
     */
    public function getPageName()
    {
        return "sidebar";
    }
}
