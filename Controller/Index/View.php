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
use Codilar\Vendor\Api\VendorRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;

class View extends  Action
{
    protected $pageFactory;
    private $request;

    public function __construct(Context                                            $context, pageFactory $pageFactory, ResultFactory $resultFactory,
                                \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
                                \Magento\Framework\UrlInterface                    $url,
                                VendorRepositoryInterface                          $vendorRepository,
                                RequestInterface                                   $request)
    {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
        $this->scopeConfig = $scopeConfig;
        $this->resultFactory = $resultFactory;
        $this->vendorRepository = $vendorRepository;
        $this->url = $url;
        $this->request = $request;
    }

    public function execute()
    {
        $model = $this->vendorRepository->load($this->request->getParam('id'));
        $enabled = $model->getData();
        $active = 0;
        if (count($enabled) > 0) {
            $active = $enabled['is_enable'];
        }
        $vendorEnabled = $this->scopeConfig->getValue('section_id/vendor_status/is_active',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if ($vendorEnabled == 1 && $active == 1) {
            $result = $this->pageFactory->create();
            $result->getConfig()->getTitle()->prepend((__('Welcome The Our sellers Store :' . $enabled['name'])));
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
