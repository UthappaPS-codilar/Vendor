<?php

namespace Codilar\Vendor\Block;

use Codilar\Vendor\Api\VendorRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\Registry;

/**
 * Class Vendor
 * @package Codilar\Vendor\Block
 */
class Vendor extends \Magento\Catalog\Block\Product\View
{
    /**
     * @var Registry
     */
    private  $registry;
    /**
     * @var VendorRepositoryInterface
     */
    private $vendorRepository;

    /**
     * Vendor constructor.
     * @param Context $context
     * @param \Magento\Framework\Url\EncoderInterface $urlEncoder
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Magento\Framework\Stdlib\StringUtils $string
     * @param \Magento\Catalog\Helper\Product $productHelper
     * @param \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig
     * @param \Magento\Framework\Locale\FormatInterface $localeFormat
     * @param \Magento\Customer\Model\Session $customerSession
     * @param ProductRepositoryInterface $productRepository
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     * @param VendorRepositoryInterface $vendorRepository
     * @param array $data
     */
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    public function __construct(
        Registry $registry,
        CollectionFactory $collectionFactory,
        Context $context,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Catalog\Helper\Product $productHelper,
        \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        \Magento\Customer\Model\Session $customerSession,
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        VendorRepositoryInterface $vendorRepository,
        array $data = []
    ) {
        parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig, $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);
        $this->vendorRepository = $vendorRepository;
        $this->collectionFactory = $collectionFactory;
        $this->registry = $registry;
    }

    /**
     * @return false|mixed
     */
    public function getVendorName()
    {

        $vendorAttribute= $this->getProduct()->getCustomAttribute('vendor_dropdown');

        if ($vendorAttribute) {
            $collection=$this->vendorRepository->getCollection();
            $collection->addFieldToFilter('is_enable', 1);
            $vendorId=$vendorAttribute->getValue();

            if (isset($vendorId)) {
                $collection->addFieldToFilter('id', $vendorId);

                $vendorInfo=$collection->getFirstItem()->getData();


                return isset($vendorInfo['name']) ? $vendorInfo:false;
            }
        }
        return false;
    }
    public function getVendorUrl()
    {
        return $this->getUrl('vendor/index/view');
    }

}
