<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Codilar\Vendor\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;

class Index extends  Action
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
            $result = $this->pageFactory->create();
            $result->getConfig()->getTitle()->prepend((__('Our Top Brand')));
            return $result;
        } else {
            $pageId = $this->_objectManager->get(
                \Magento\Framework\App\Config\ScopeConfigInterface::class,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            )->getValue(
                \Magento\Cms\Helper\Page::XML_PATH_NO_ROUTE_PAGE,
                \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );
            /** @var \Magento\Cms\Helper\Page $pageHelper */
            $pageHelper = $this->_objectManager->get(\Magento\Cms\Helper\Page::class);
            $resultPage = $pageHelper->prepareResultPage($this, $pageId);
            if ($resultPage) {
                $resultPage->setStatusHeader(404, '1.1', 'Not Found');
                $resultPage->setHeader('Status', '404 File not found');
                return $resultPage;
            }
        }

    }
}

