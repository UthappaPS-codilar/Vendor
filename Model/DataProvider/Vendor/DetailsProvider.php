<?php
namespace Codilar\Vendor\Model\DataProvider\Vendor;

use Codilar\Vendor\Model\ResourceModel\Vendor\CollectionFactory as CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class DetailsProvider
 * @package Codilar\Vendor\Model\DataProvider\Vendor
 */
class DetailsProvider extends AbstractDataProvider
{
    protected $loadedData;
    private $request;
    /**
     * @var Collection
     */
    private $collectionFactory;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $collectionFactory
     * @param string $request
     * @param string $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
        $this->request = $request;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $id = $this->request->getParam('id');
        $items = $this->collectionFactory->create()->addFieldToFilter('id', $id)->getItems();
        foreach ($items as $item) {
            $vendorData = $item->getData();
            $this->loadedData[$item->getId()] = $vendorData;
        }
        return $this->loadedData;
    }
}
