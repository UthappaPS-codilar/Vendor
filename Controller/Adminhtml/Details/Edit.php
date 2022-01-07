<?php

namespace Codilar\Vendor\Controller\Adminhtml\Details;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

/**
 * Class Edit
 * @package Codilar\Vendor\Controller\Adminhtml\Details
 */
class Edit extends Action
{

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultResponse = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultResponse->getConfig()->getTitle()->set(__("Edit Vendor Information"));
        return $resultResponse;
    }
}
