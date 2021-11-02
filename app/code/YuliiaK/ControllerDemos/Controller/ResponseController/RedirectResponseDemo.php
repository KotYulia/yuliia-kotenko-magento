<?php
declare(strict_types=1);

namespace YuliiaK\ControllerDemos\Controller\ResponseController;

use Magento\Framework\Controller\Result\Redirect;

class RedirectResponseDemo implements
    \Magento\Framework\App\Action\HttpGetActionInterface
{
    /**
     * @var \Magento\Framework\Controller\Result\RedirectFactory
     */
    private \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory;

    /**
     * RedirectResponseDemo constructor.
     * @param \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory
     */
    public function __construct(
        \Magento\Framework\Controller\Result\RedirectFactory $redirectFactory
    ) {
        $this->redirectFactory = $redirectFactory;
    }

    /**
     * * Layout result demo: https://yuliia-kotenko-magento.us/yuliiak-controller-demos/responsecontroller/redirectresponsedemo
     *
     * @return Redirect
     */
    public function execute(): Redirect
    {
        $result = $this->redirectFactory->create();

        return $result->setUrl('https://github.com/KotYulia/yuliia-kotenko-magento');
    }
}
