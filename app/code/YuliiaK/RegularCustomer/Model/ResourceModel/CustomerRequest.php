<?php
declare(strict_types=1);

namespace YuliiaK\RegularCustomer\Model\ResourceModel;

class CustomerRequest extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @var string $_idFieldName
     */
    protected $_idFieldName = 'request_id';

    /**
     * @inheritDoc
     */
    protected function _construct(): void
    {
        $this->_init('yuliiak_regular_customer_request', 'request_id');
    }
}
