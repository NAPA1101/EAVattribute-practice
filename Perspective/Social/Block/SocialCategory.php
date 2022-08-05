<?php

namespace Perspective\Social\Block;

use \Magento\Catalog\Block\Product\ListProduct;
use \Perspective\Social\Helper\Data;
use \Magento\Catalog\Model\Product;
use \Magento\Framework\Url\Helper\Data as urlHelper;
use \Magento\Catalog\Block\Product\Context;
use \Magento\Framework\Data\Helper\PostHelper;
use \Magento\Catalog\Model\Layer\Resolver;
use \Magento\Catalog\Api\CategoryRepositoryInterface;


class SocialCategory extends ListProduct
{
    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @var Product
     */
    protected $_productCatalog;

    /**
     * @param Data $helperData
     * @param Product $_productCatalog
     * @param urlHelper $urlHelper
     * @param PostHelper $postDataHelper
     * @param Resolver $layerResolver
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        Data $helperData,
        Product $_productCatalog,
        urlHelper $urlHelper,
        Context $context,
        PostHelper $postDataHelper,
        Resolver $layerResolver,
        CategoryRepositoryInterface $categoryRepository,
        array $data = [])

    {
        $this->helperData = $helperData;
        $this->_productCatalog = $_productCatalog;
        parent::__construct($context, $postDataHelper, $layerResolver, $categoryRepository, $urlHelper, $data);
    }

    public function EnableAttribute($id)
    {
        if ($this->helperData->getGeneralConfig('enable')) {
            return $this->_productCatalog->load($id)->getSocial();
        }
    }
}
