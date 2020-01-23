<?php
namespace RS\FeaturedProducts\Model\Config\Source;

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
