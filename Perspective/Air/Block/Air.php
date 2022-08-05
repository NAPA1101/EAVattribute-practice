<?php
namespace Perspective\Air\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Perspective\Air\Helper\AirHelper;
use \Magento\Catalog\Model\Product;
use \Magento\Catalog\Model\ProductRepository;
use \Magento\Framework\Registry;


class Air extends Template
{
    /**
     * @var AirHelper
     */
    protected $_helperAir;

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
     * @param AirHelper $helperAir
     * @param Product $productCatalog
     * @param ProductRepository $productRepository
     *
     */
    public function __construct(
        Context $context,
        AirHelper $helperAir,
        Product $productCatalog,
        ProductRepository $productRepository,
        Registry $registry,
        array $data = [])

    {
        $this->_helperAir = $helperAir;
        $this->_registry = $registry;
        $this->_productRepository = $productRepository;
        $this->_productCatalog = $productCatalog;
        parent::__construct($context, $data);
    }

    public function getCurrentProduct() : Registry
    {
        return $this->_registry->registry('current_product');
    }

    /** 
     * @return string
     */
    public function getValueAttribute() : string
    {
        return $this->_productCatalog->load($this->getCurrentProduct()->getId())->getAir();
    }

    public function getEnableModule()
    {
        return $this->_helperAir->getGeneralConfig('enable');
    }

    public function getWeight()
    {
        return $this->_productCatalog->load($this->getCurrentProduct()->getId())->getWeight();
    }

    public function getOverWeight()
    {
        return $this->_helperAir->getGeneralConfig($this->getValueAttribute() . 'X');
    }

    public function getSurcharge()
    {
        return $this->_helperAir->getGeneralConfig($this->getValueAttribute() . 'Y');
    }

    public function getMarkup()
    {
        $difference = $this->getOverWeight() - $this->getWeight();
        return $difference * $this->getSurcharge();
    }
}
