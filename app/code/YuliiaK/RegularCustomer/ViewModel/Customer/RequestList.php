<?php
declare(strict_types=1);

namespace YuliiaK\RegularCustomer\ViewModel\Customer;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\Collection as ProductCollection;
use Magento\Store\Model\Website;
use YuliiaK\RegularCustomer\Model\ResourceModel\CustomerRequest\Collection as CustomerRequestCollection;
use YuliiaK\RegularCustomer\Model\ResourceModel\CustomerRequest\CollectionFactory as CustomerRequestCollectionFactory;

class RequestList implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var CustomerRequestCollectionFactory $customerRequestCollectionFactory
     */
    private CustomerRequestCollectionFactory $customerRequestCollectionFactory;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     */
    private \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    private \Magento\Store\Model\StoreManagerInterface $storeManager;

    /**
     * @var CustomerRequestCollection $loadedCustomerRequestCollection
     */
    private CustomerRequestCollection $loadedCustomerRequestCollection;

    /**
     * @var ProductCollection $loadedProductCollection
     */
    private ProductCollection $loadedProductCollection;

    /**
     * @var \Magento\Catalog\Model\Product\Visibility $productVisibility
     */
    private \Magento\Catalog\Model\Product\Visibility $productVisibility;

    /**
     * @param CustomerRequestCollectionFactory $customerRequestCollectionFactory
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Catalog\Model\Product\Visibility $productVisibility
     */
    public function __construct(
        CustomerRequestCollectionFactory $customerRequestCollectionFactory,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Catalog\Model\Product\Visibility $productVisibility
    ) {
        $this->customerRequestCollectionFactory = $customerRequestCollectionFactory;
        $this->storeManager = $storeManager;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->productVisibility = $productVisibility;
    }

    /**
     * Get a list of customer requests
     *
     * @return CustomerRequestCollection
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getCustomerRequestCollection(): CustomerRequestCollection
    {
        if (isset($this->loadedCustomerRequestCollection)) {
            return $this->loadedCustomerRequestCollection;
        }

        /** @var Website $website */
        $website = $this->storeManager->getWebsite();

        /** @var CustomerRequestCollection $collection */
        $collection = $this->customerRequestCollectionFactory->create();
        // @TODO: get current customer's ID
        // $collection->addFieldToFilter('customer_id', 2);
        // @TODO: check if accounts are shared per website or not
        $collection->addFieldToFilter('store_id', ['in' => $website->getStoreIds()]);
        $this->loadedCustomerRequestCollection = $collection;

        return $this->loadedCustomerRequestCollection;
    }

    /**
     * Get product for customer request
     *
     * @param int $productId
     * @return Product|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getProduct(int $productId): ?Product
    {
        if (isset($this->loadedProductCollection)) {
            return $this->loadedProductCollection->getItemById($productId);
        }

        $customerRequestCollection = $this->getCustomerRequestCollection();
        $productIds = array_filter($customerRequestCollection->getColumnValues('product_id'));

        $productCollection = $this->productCollectionFactory->create();
        $productCollection->addAttributeToFilter('entity_id', ['in' => $productIds])
            ->addAttributeToSelect('name')
            ->addWebsiteFilter()
            ->setVisibility($this->productVisibility->getVisibleInSiteIds());
        $this->loadedProductCollection = $productCollection;

        return $this->loadedProductCollection->getItemById($productId);
    }
}
