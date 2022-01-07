<?php


namespace Codilar\Vendor\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * class Vendor
 *
 * A magento 2 module to have sellers for products
 *
 */
class Vendor extends AbstractDb
{
    /**
     *  Here init method takes table, primary key as params
     */
    protected function _construct()
    {
        $this->_init('codilar_vendor', 'id');
    }
}
