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

namespace RS\FeaturedProducts\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Model\ResourceModel\Eav\Attribute;

/** 
 * Class InstallData
 * 
 * @category RSExtensions
 * @package  RS\FeaturedProducts\Setup
 * @author   Raju Sadadiya <rsadadiya@gmail.com>
 * @license  OSL 3.0
 * @link     http://www.rajusadadiya.com
 */
class InstallData implements InstallDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $_eavSetupFactory;

    /**
     * Init
     *
     * @param EavSetupFactory $eavSetupFactory EnvSetupfactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->_eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Install Data script
     * 
     * @param ModuleDataSetupInterface $setup   Setup Object
     * @param ModuleContextInterface   $context Context Object
     * 
     * @return void
     */
    public function install(
        ModuleDataSetupInterface $setup, 
        ModuleContextInterface $context
    ) {
        
        $eavSetup = $this->_eavSetupFactory->create(['setup' => $setup]);        
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY, 'rs_is_featured', [
            'group' => 'Product Details',
            'type' => 'int',
            'sort_order' => 95,
            'backend' => '',
            'frontend' => '',
            'label' => 'Is Featured',
            'input' => 'boolean',
            'class' => '',
            'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
            'global' => Attribute::SCOPE_GLOBAL,
            'visible' => true,
            'required' => false,
            'user_defined' => true,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'unique' => false,
            'apply_to' => 'simple,configurable,virtual,bundle,downloadable'
            ]
        );
    }
}
