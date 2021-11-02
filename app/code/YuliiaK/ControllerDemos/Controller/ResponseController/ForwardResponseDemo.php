<?php
declare(strict_types=1);

namespace YuliiaK\ControllerDemos\Controller\ResponseController;

use Magento\Framework\Controller\Result\Forward;

class ForwardResponseDemo implements
    \Magento\Framework\App\Action\HttpGetActionInterface
{
    /**
     * @var \Magento\Framework\Controller\Result\ForwardFactory
     */
    private \Magento\Framework\Controller\Result\ForwardFactory $forwardFactory;

    /**
     * ForwardResponseDemo constructor.
     * @param \Magento\Framework\Controller\Result\ForwardFactory $forwardFactory
     */
    public function __construct(
        \Magento\Framework\Controller\Result\ForwardFactory $forwardFactory
    ) {
        $this->forwardFactory = $forwardFactory;
    }

    /**
     * * Layout result demo: https://yuliia-kotenko-magento.us/yuliiak-controller-demos/responsecontroller/forwardresponsedemo
     *
     * @return Forward
     */
    public function execute(): Forward
    {
        $result = $this->forwardFactory->create();

        return $result->forward('datafromform');
    }
}
