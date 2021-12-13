<?php
declare(strict_types=1);

namespace YuliiaK\RegularCustomer\Model\ResourceModel\CustomerRequest;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @inheritDoc
     */
    protected function _construct(): void
    {
        parent::_construct();
        $this->_init(
            \YuliiaK\RegularCustomer\Model\CustomerRequest::class,
            \YuliiaK\RegularCustomer\Model\ResourceModel\CustomerRequest::class
        );
    }
}
