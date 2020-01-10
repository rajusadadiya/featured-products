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

class FeaturedBlock extends \RS\FeaturedProducts\Block\AbstractFeaturedProduct
{
	const PAGE_NAME = "block";

    public function getPageName()
    {
        return self::PAGE_NAME;
    }
}
