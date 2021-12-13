<?php
declare(strict_types=1);

namespace YuliiaK\RegularCustomer\Controller\Index;

use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Redirect;
use YuliiaK\RegularCustomer\Model\CustomerRequest;

class Request implements
    \Magento\Framework\App\Action\HttpPostActionInterface,
    \Magento\Framework\App\CsrfAwareActionInterface
{
    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    private \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    private \Magento\Framework\Message\ManagerInterface $messageManager;

    /**
     * @var \YuliiaK\RegularCustomer\Model\CustomerRequestFactory
     */
    private $customerRequestFactory;

    /**
     * @var \YuliiaK\RegularCustomer\Model\ResourceModel\CustomerRequest
     */
    private $customerRequestResource;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     */
    private \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator;

    /**
     * @param \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \YuliiaK\RegularCustomer\Model\CustomerRequestFactory $customerRequestFactory
     * @param \YuliiaK\RegularCustomer\Model\ResourceModel\CustomerRequest $customerRequestResource
     * @param RequestInterface $request
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
     */
    public function __construct(
        \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \YuliiaK\RegularCustomer\Model\CustomerRequestFactory $customerRequestFactory,
        \YuliiaK\RegularCustomer\Model\ResourceModel\CustomerRequest $customerRequestResource,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
    ) {
        $this->redirectFactory = $redirectFactory;
        $this->messageManager = $messageManager;
        $this->customerRequestFactory = $customerRequestFactory;
        $this->customerRequestResource = $customerRequestResource;
        $this->request = $request;
        $this->storeManager = $storeManager;
        $this->logger = $logger;
        $this->formKeyValidator = $formKeyValidator;
    }

    /**
     * Controller action
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        /**
         * @var CustomerRequest $customerRequest
         */
        $customerRequest = $this->customerRequestFactory->create();

        try {
            if ($productId = $this->request->getParam('product_id')) {
                $customerRequest->setProductId((int)$productId);
            }

            $customerRequest->setName($this->request->getParam('name'))
                ->setEmail($this->request->getParam('email'))
                ->setStoreId($this->storeManager->getStore()->getId());

            $this->customerRequestResource->save($customerRequest);
            $this->messageManager->addSuccessMessage(
                __('You request for product %1 accepted for review!', $this->request->getParam('productName'))
            );
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage(
                __('Your request can\'t be sent. Please, contact us if you see this message.')
            );
        }

        $redirect = $this->redirectFactory->create();
        $redirect->setRefererUrl();

        return $redirect;
    }

    /**
     * Create exception in case CSRF validation failed. Return null if default exception will suffice.
     *
     * @param RequestInterface $request
     * @return InvalidRequestException|null
     */
    public function createCsrfValidationException(RequestInterface $request): ?InvalidRequestException
    {
        return null;
    }

    /**
     * Perform custom request validation. Return null if default validation is needed.
     *
     * @param RequestInterface $request
     * @return bool|null
     */
    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return $this->formKeyValidator->validate($request);
    }
}
