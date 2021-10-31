<?php
declare(strict_types=1);


namespace YuliiaK\ControllerDemos\Controller\ResponseController;

use Magento\Framework\Controller\Result\Raw;


class RawResponseDemo implements
    \Magento\Framework\App\Action\HttpGetActionInterface
{
    /**
     * @var \Magento\Framework\Controller\Result\RawFactory
     */
    private \Magento\Framework\Controller\Result\RawFactory $rawFactory;

    /**
     * RawResponseDemo constructor.
     * @param \Magento\Framework\Controller\Result\RawFactory $rawFactory
     */
    public function __construct(
        \Magento\Framework\Controller\Result\RawFactory $rawFactory
    ) {
        $this->rawFactory = $rawFactory;
    }

    /**
     * @return Raw
     */
    public function execute(): Raw
    {
        $result = $this->rawFactory->create();

        return $result->setHeader('Content-Type', 'text/html')
            ->setContents(<<<HTML
<h1>RawResponseDemo page</h1>
<ul>
    <li>
        <a href="/yuliiak-controller-demos/responsecontroller/jsonresponsedemo">JsonResponseDemo page</a>
    </li>
    <li>
        <a href="/yuliiak-controller-demos/responsecontroller/redirectresponsedemo" target="_blank">RedirectResponseDemo page</a>
    </li>
    <li>
        <a href="/yuliiak-controller-demos/responsecontroller/forwardresponsedemo">ForwardResponseDemo page</a>
    </li>
</ul>
<form action="/yuliiak-controller-demos/responsecontroller/jsonresponsedemo" method="get">
    <label for="vendor-name">Vendor name: </label>
    <input id="vendor-name" name="vendor_name" value="YuliiaK">
    <label for="module-name">Module name: </label>
    <input id="module-name" name="module_name" value="ControllerDemos">
    <button type="submit">Submit</button>
</form>
HTML);
    }
}
