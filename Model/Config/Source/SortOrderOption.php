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

namespace RS\FeaturedProducts\Model\Config\Source;

/** 
 * Class SortOrderOption
 * 
 * @category RSExtensions
 * @package  RS\FeaturedProducts\Model\Config\Source
 * @author   Raju Sadadiya <rsadadiya@gmail.com>
 * @license  OSL 3.0
 * @link     http://www.rajusadadiya.com
 */
class SortOrderOption implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'ASC', 'label' => __('Ascending')],
            ['value' => 'DESC', 'label' => __('Descending')]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return ["ASC" => __('Ascending'), "DESC" => __('Descending')];
    }
}
