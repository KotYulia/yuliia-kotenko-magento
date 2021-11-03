<?php
declare(strict_types=1);

namespace YuliiaK\ControllerDemos\Controller\ResponseController;

use Magento\Framework\View\Result\Page;

class DataFromForm implements
    \Magento\Framework\App\Action\HttpGetActionInterface
{
    private \Magento\Framework\View\Result\PageFactory $pageFactory;

    /**
     * PageResponse constructor.
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     */
    public function __construct(
        \Magento\Framework\View\Result\PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
    }

    /**
     * Layout result demo: https://yuliia-kotenko-magento.us/yuliiak-controller-demos/responsecontroller/datafromform
     *
     * @return Page
     */
    public function execute(): Page
    {
        return $this->pageFactory->create();
    }
}
