<?php
namespace Codilar\Vendor\Model\Source\Config\Vendor;

use Codilar\Vendor\Model\ResourceModel\Vendor\Collection;
use Codilar\Vendor\Model\ResourceModel\Vendor\CollectionFactory;

/**
 * Class Vendordropdown
 * @package Codilar\Vendor\Model\Source\Config\Vendor
 */
class Vendordropdown extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Vendordropdown constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param bool $addEmpty
     * @return array
     */
    public function getAllOptions($addEmpty = true): array
    {

            /** @var Collection $collection */
        $collections = $this->collectionFactory->create();
            $result = [];
            $result[] = [
            'label'=>'-----Select-----',
            'value'=>''
            ];
            foreach ($collections as $collection) {
                if ($collection->getIsEnable()) {
                    $result[] = [
                    'label'=>$collection->getName(),
                    'value'=>$collection->getId()
                    ];
                }
            }
            return $result;
    }
}
