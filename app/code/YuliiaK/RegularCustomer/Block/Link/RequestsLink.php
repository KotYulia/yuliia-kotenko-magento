<?php
declare(strict_types=1);

namespace YuliiaK\RegularCustomer\Block\Link;

use Magento\Customer\Block\Account\SortLinkInterface;

class RequestsLink extends \Magento\Framework\View\Element\Html\Link implements SortLinkInterface
{
    /**
     * Get URL
     *
     * @return string
     */
    public function getHref()
    {
        return $this->getUrl('yuliiak_regular_customer/request/view');
    }

    /**
     * Get link order
     *
     * @return int|mixed
     */
    public function getSortOrder()
    {
        return $this->getData(self::SORT_ORDER);
    }
}
