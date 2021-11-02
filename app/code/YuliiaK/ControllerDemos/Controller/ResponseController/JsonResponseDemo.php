<?php
declare(strict_types=1);


namespace YuliiaK\ControllerDemos\Controller\ResponseController;

use Magento\Framework\Controller\Result\Json;


class JsonResponseDemo implements
    \Magento\Framework\App\Action\HttpGetActionInterface
{
    private \Magento\Framework\App\RequestInterface $request;
    private \Magento\Framework\Controller\Result\JsonFactory $jsonFactory;

    /**
     * JsonResponseDemo constructor.
     * @param \Magento\Framework\App\RequestInterface $request
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     */
    public function __construct(
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
    ) {
        $this->request = $request;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * @return Json
     */
    public function execute(): Json
    {
        $result = $this->jsonFactory->create();

        return $result->setData([
            'vendor_name' => $this->request->getParam('vendor_name'),
            'module_name' => $this->request->getParam('module_name')
        ]);
    }
}
