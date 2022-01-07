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
 * Class Save
 * @package Codilar\Vendor\Controller\Adminhtml\Details
 */
class Save implements ActionInterface
{
    private $resultFactory;
    private $request;
    private $url;
    private $customerRepository;
    private $manager;

    /**
     * Save constructor.
     * @param ResultFactory $resultFactory
     * @param RequestInterface $request
     * @param CustomerRepositoryInterface $customerRepository
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
        try {
            $model = $this->vendorRepository->load($this->request->getParam('id'));
            $model->setData($this->request->getParams());
            $this->vendorRepository->save($model);
            $this->manager->addSuccessMessage(
                __(sprintf(
                    'The Vendor %s Information has been saved Successfully',
                    $this->request->getParam('name')
                ))
            );
        } catch (\Exception $exception) {
            $this->manager->addErrorMessage(
                __(sprintf(
                    'The Vendor %s Information has not been saved due to Some Technical Reason',
                    $this->request->getParam('name')
                ))
            );
        }
        return $redirectResponse;
    }
}
