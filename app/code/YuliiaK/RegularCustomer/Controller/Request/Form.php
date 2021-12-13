<?php
declare(strict_types=1);

namespace YuliiaK\RegularCustomer\Controller\Request;

use Magento\Framework\View\Result\Page;

class Form implements \Magento\Framework\App\Action\HttpGetActionInterface
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private \Magento\Framework\View\Result\PageFactory $pageFactory;

    /**
     *
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     */
    public function __construct(\Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        /** @var $pageFactory */
        $this->pageFactory = $pageFactory;
    }

    /**
     * Get Page
     *
     * @return Page
     */
    public function execute(): Page
    {
        return $this->pageFactory->create();
    }
}
