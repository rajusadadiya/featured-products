<?php
namespace RS\FeaturedProducts\Model\Config\Source;

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
        return ["name" => __('Name'), "price" => __('Price'), "created_at" => __("Created Date")];
    }
}
