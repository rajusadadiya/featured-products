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
 * @author  Raju Sadadiya <rsadadiya@gmail.com>
 * @license OSL 3.0
 * @link    http://www.rajusadadiya.com
 */

namespace RS\FeaturedProducts\Model\Config\Source;

/**
 * Class SortOption
 *
 * Provide sort option in admin configuration section
 *
 * @author  Raju Sadadiya <rsadadiya@gmail.com>
 * @license OSL 3.0
 * @link    http://www.rajusadadiya.com
 */
class SortOption implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'name', 'label' => __('Name')],
            ['value' => 'price', 'label' => __('Price')],
            ['value' => 'created_at', 'label' => __('Created Date')]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [
            "name" => __('Name'),
            "price" => __('Price'),
            "created_at" => __("Created Date")
            ];
    }
}
