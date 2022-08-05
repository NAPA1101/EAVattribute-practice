<?php

namespace Perspective\Social\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Perspective\Social\Helper\Data;
use \Magento\Catalog\Model\Product;
use \Magento\Catalog\Model\ProductRepository;
use \Magento\Framework\Registry;

class Social extends Template
{

    /**
     * @var Data
     */
    protected $helperData;

    /**
     * @var Registry
     */
    protected $_registry;

    /**
     * @var ProductRepository
     */
    protected $_productRepository;

    /**
     * @var Product
     */
    protected $_productCatalog;

    /**
     * @param Data $helperData
     * @param Product $productCatalog
     * @param ProductRepository $productRepository
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        Data $helperData,
        Product $productCatalog,
        ProductRepository $productRepository,
        Registry $registry,
        array $data = [])

    {
        parent::__construct($context, $data);

        $this->helperData = $helperData;
        $this->_registry = $registry;
        $this->_productRepository = $productRepository;
        $this->_productCatalog = $productCatalog;
    }

    public function EnablePercent()
    {
        if ($this->helperData->getGeneralConfig('enable') == 1) {
            return $this->helperData->getGeneralConfig('percent');
        } else {
            return null;
        }
    }

    public function CurrentProduct() {
        return $this->_registry->registry('current_product');
    }

    public function PriceProduct() {
        return $this->_productRepository->getById($this->CurrentProduct()->getId() - 1)->getPrice();
    }

    public function EnableCustomAttribute()
    {
        if ($this->helperData->getGeneralConfig('enable')) {
            return $this->_productCatalog->load($this->CurrentProduct()->getId())->getSocial();
        } else {
            return null;
        }
    }

    public function DiscountPrice()
    {
        return $this->PriceProduct() * (100 - $this->EnablePercent()) / 100;
    }
}
