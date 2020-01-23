<?php

namespace RS\ProductQuestionAnswer\Model\Config\Source;

class WhoGiveAnswer implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => '1', 'label' => __('Any (Guest | Registered Customer | Admin)')],
            ['value' => '2', 'label' => __('Registered Customers')],
            ['value' => '3', 'label' => __('Admin')]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [0 => __('Any (Guest | Registered Customer | Admin)'), 1 => __('Registered Customers'), 2 => __('Admin')];
    }
}
