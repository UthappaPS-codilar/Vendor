<?php

namespace Codilar\Vendor\Controller\Adminhtml\Details;

use Codilar\Vendor\Api\VendorRepositoryInterface;
use Magento\Backend\Model\UrlInterface;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;

/**
 * Class Delete
 * @package Codilar\Vendor\Controller\Adminhtml\Details
 */
class Delete implements ActionInterface
{
    private $resultFactory;
    private $request;
    private $url;
    private $vendorRepository;
    private $manager;

    /**
     * Save constructor.
     * @param ResultFactory $resultFactory
     * @param RequestInterface $request
     * @param VendorRepositoryInterface $vendorRepository
     * @param ManagerInterface $manager
     * @param UrlInterface $url
     */
    public function __construct(
        ResultFactory $resultFactory,
        RequestInterface $request,
        VendorRepositoryInterface $vendorRepository,
        ManagerInterface $manager,
        UrlInterface $url
    ) {
        $this->resultFactory = $resultFactory;
        $this->request = $request;
        $this->url = $url;
        $this->vendorRepository = $vendorRepository;
        $this->manager = $manager;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $redirectResponse = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirectResponse->setUrl($this->url->getUrl('vendor/details/index'));
        $result = $this->vendorRepository->deleteById($this->request->getParam('id'));
        if ($result) {
            $this->manager->addSuccessMessage(
                __(sprintf(
                    'The Vendor with id %s has been deleted Successfully',
                    $this->request->getParam('id')
                ))
            );
        } else {
            $this->manager->addErrorMessage(
                __(sprintf(
                    'The Vendor with id %s has not been deleted, Due to some technical reasons',
                    $this->request->getParam('id')
                ))
            );
        }
        return $redirectResponse;
    }
}
