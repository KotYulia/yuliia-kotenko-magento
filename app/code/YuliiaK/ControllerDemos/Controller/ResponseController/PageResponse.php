<?php
declare(strict_types=1);

namespace YuliiaK\ControllerDemos\Controller\ResponseController;

use Magento\Framework\View\Result\Page;

class PageResponse implements
    \Magento\Framework\App\Action\HttpGetActionInterface
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
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
     * Layout result demo: /yuliiak-controller-demos/responsecontroller/pageresponse
     *
     * @return Page
     */
    public function execute(): Page
    {
        return $this->pageFactory->create();
    }
}
