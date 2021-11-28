<?php
declare(strict_types=1);

namespace YuliiaK\RegularCustomer\Model;

/**
 * @method int|string|null getCustomerRequestId()
 * @method int|string|null getProductId()
 * @method $this setProductId(int $productId)
 * @method int|string|null getCustomerId()
 * @method $this setCustomerId(int $customerId)
 * @method string|null getName()
 * @method $this setName(string $name)
 * @method string|null getEmail()
 * @method $this setEmail(string $name)
 * @method int|string|null getStoreId()
 * @method $this setStoreId(int $websiteId)
 * @method int|string|null getAdminUserId()
 * @method $this setAdminUserId(int $adminUserId)
 * @method int|string|null getCreatedAt()
 * @method int|string|null getUpdatedAt()
 */
class CustomerRequest extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @inheritDoc
     */
    protected function _construct(): void
    {
        parent::_construct();
        $this->_init(\YuliiaK\RegularCustomer\Model\ResourceModel\CustomerRequest::class);
    }
}
