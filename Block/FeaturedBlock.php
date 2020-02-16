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

/** 
 * Class FeaturedBlock
 * 
 * @category RSExtensions
 * @package  RS\FeaturedProducts\Block
 * @author   Raju Sadadiya <rsadadiya@gmail.com>
 * @license  OSL 3.0
 * @link     http://www.rajusadadiya.com
 */

class FeaturedBlock extends \RS\FeaturedProducts\Block\AbstractFeaturedProduct
{
    /**
     * Set default page name
     */
    const PAGE_NAME = "block";
    
    /**
     * Return Page name
     * 
     * @return string
     */
    public function getPageName()
    {
        return self::PAGE_NAME;
    }
}
