<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

namespace Tigren\ApplyDiscount\Plugin\Catalog\Product;

use Magento\Catalog\Block\Product\ListProduct;
use Magento\Customer\Model\SessionFactory;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\CustomerGroupCatalog\CollectionFactory;

/**
 *
 */
class ApplyDiscountProduct
{
    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * @var SessionFactory
     */
    protected $sessionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     * @param SessionFactory $sessionFactory
     */
    public function __construct(CollectionFactory $collectionFactory, SessionFactory $sessionFactory)
    {
        $this->collectionFactory = $collectionFactory;
        $this->sessionFactory = $sessionFactory;
    }

    /**
     * @param ListProduct $subject
     * @param \Closure $proceed
     * @param $product
     * @return string|null
     */
    public function aroundGetProductPrice(ListProduct $subject, \Closure $proceed, $product)
    {
        $originalPrice = $product->getFinalPrice();
        $formattedPrice = number_format($originalPrice, 2);

        $session = $this->sessionFactory->create();

        if ($session->isLoggedIn()) {
            $customer = $session->getCustomer();
            $group = $customer->getGroupId();
        }
        $collection = $this->collectionFactory->create();

        $productIds = $collection->getColumnValues('product_ids');
        $discountRate = $collection->getColumnValues('discount_amount');
        $startTime = $collection->getColumnValues('start_time');
        $endTime = $collection->getColumnValues('end_time');
        $currentTime = date('Y-m-d H:i:s');
        $priority = $collection->getColumnValues('priority');
        $customerGroupId = $collection->getColumnValues('customer_group_ids');
        $active = $collection->getColumnValues('is_active');

        if ($session->isLoggedIn()) {
            $selectedProduct = null;
            foreach ($productIds as $key => $value) {
                if ($product->getId() == $productIds[$key]
                    && $currentTime >= $startTime[$key] && $currentTime <= $endTime[$key]
                    && $group = $customerGroupId[$key] && $active[$key] == 1
                ) {
                    if ($selectedProduct === null || $priority[$key] < $priority[$selectedProduct]) {
                        $selectedProduct = $key;
                    }
                }
            }
            if ($selectedProduct !== null) {
                $discountedPrice = $this->applyDiscount($originalPrice, $discountRate[$selectedProduct] / 100);
                $discountedPrice = number_format($discountedPrice, 2);
                return '<strong class="product-price">' . __('Price: $') . $discountedPrice . '</strong>' .
                    ' <del style="color:grey;"> $' . $formattedPrice . '</del>';
            }
        }

        if (!$session->isLoggedIn()) {
            return '<a href="' . $subject->getUrl('customer/account/login') . '"><strong>Please Login</strong></a>';
        }
        return '<strong class="product-price">' . __('Price: $') . $formattedPrice . '</strong>';
    }

    /**
     * @param $price
     * @param $discountRate
     * @return float|int
     */
    protected function applyDiscount($price, $discountRate)
    {
        return $price - ($price * $discountRate);
    }
}

