<?php


namespace Codilar\Vendor\Model;

use Magento\Framework\Model\AbstractModel;
use Codilar\Vendor\Model\ResourceModel\Vendor as ResourceModel;

/**
 * class Vendor
 *
 * A magento 2 module to have sellers for products
 *
 */
class Vendor extends AbstractModel
{
    /**
     * Here init method takes Resource Model Class as param
     */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
