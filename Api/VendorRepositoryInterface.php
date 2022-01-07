<?php
namespace Codilar\Vendor\Api;

use Codilar\Vendor\Model\Vendor as Model;
use Magento\Framework\Api\SearchCriteriaInterface;
use Amasty\Example\Api\Data\AmastyInterface;

/**
 * Interface VendorRepositoryInterface
 * @package Codilar\Vendor\Api
 */
interface VendorRepositoryInterface
{
    /**
     * @param $id
     * @return Model
     */
    public function getDataById($id);

    /**
     * @param Model $model
     * @return Model
     */
    public function save(Model $model);

    /**
     * @param Model $model
     * @return Model
     */
    public function afterSave(Model $model);

    /**
     * @param Model $model
     * @return Model
     */
    public function delete(Model $model);

    /**
     * @param $value
     * @param null $field
     * @return Model
     */
    public function load($value, $field = null);

    /**
     * @return Model $model
     */
    public function create();

    /**
     * @param $id
     * @return Model
     */
    public function deleteById($id);

    /**
     * @return Model
     */
    public function getCollection();
}
