<?php


namespace Codilar\Vendor\Model\ResourceModel\Vendor;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Codilar\Vendor\Model\Vendor as Model;
use Codilar\Vendor\Model\ResourceModel\Vendor as ResourceModel;

/**
 * class Collection
 *
 *
 * A magento 2 module to have vendors for products
 *
 */
class Collection extends AbstractCollection
{
    /**
     *  Here init method takes Model, ResourceModel classes as params
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
