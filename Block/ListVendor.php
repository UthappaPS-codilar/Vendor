<?php

namespace Codilar\Vendor\Block;

use Codilar\Vendor\Api\VendorRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Block\Product\Context;
use Magento\Framework\Stdlib\StringUtils;
use Magento\Framework\Json\EncoderInterface;
class ListVendor extends \Magento\Catalog\Block\Product\View
{

    /**
     * @var VendorRepositoryInterface
     */
    private $vendorRepository;


    /**
     * Vendor constructor.
     * @param Context $context
     * @param \Magento\Framework\Url\EncoderInterface $urlEncoder
     * @param EncoderInterface $jsonEncoder
     * @param StringUtils $string
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

        Context $context,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        EncoderInterface $jsonEncoder,
        StringUtils $string,
        \Magento\Catalog\Helper\Product $productHelper,
        \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        \Magento\Customer\Model\Session $customerSession,
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        VendorRepositoryInterface $vendorRepository,

        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        parent::__construct($context, $urlEncoder, $jsonEncoder, $string, $productHelper, $productTypeConfig, $localeFormat, $customerSession, $productRepository, $priceCurrency, $data);
        $this->vendorRepository = $vendorRepository;

        $this->scopeConfig = $scopeConfig;

    }

    /**
     * @return false|mixed
     */
    public function getVendorList()
    {

            $collection = $this->vendorRepository->getCollection();
            $result = [];
            foreach ($collection->getItems() as $vendor) {
                if ($vendor['is_enable'] == 1) {
                    $result[] = [
                        'name' => $vendor->getName(),
                        'id' => $vendor->getId()
                    ];

                }

            }
            return $result;

    }
    public function getVendorUrl()
    {
        return $this->getUrl('vendor/index/view');
    }
}
