<?php
/**
 * registration.php
 *
 * A magento 2 module to have Vendors for products
 */
use \Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'Codilar_Vendor',
    __DIR__
);
