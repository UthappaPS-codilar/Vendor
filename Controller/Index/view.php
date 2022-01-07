<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Codilar\Vendor\Controller\Index;


use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;

class View extends  Action
{
    protected $pageFactory;

    public function __construct(Context                                            $context, pageFactory $pageFactory, ResultFactory $resultFactory,
                                \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
                                \Magento\Framework\UrlInterface                    $url)
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->scopeConfig = $scopeConfig;
        $this->resultFactory = $resultFactory;
        $this->url = $url;
    }

    public function execute()
    {
        $vendorEnabled = $this->scopeConfig->getValue('section_id/vendor_status/is_active',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if ($vendorEnabled == 1) {
            return $this->pageFactory->create();
        } else {
            $redirectResponse = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $redirectResponse->setUrl($this->url->getUrl('*/*/no-route/'));
            return $redirectResponse;
        }

    }
}
