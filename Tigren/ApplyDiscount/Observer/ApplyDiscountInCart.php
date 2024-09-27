<?php

namespace Tigren\ApplyDiscount\Observer;

use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\CustomerGroupCatalog\CollectionFactory;
use Magento\Customer\Model\SessionFactory;

class ApplyDiscountInCart implements ObserverInterface
{
    protected $checkoutSession;
    protected $collectionFactory;
    protected $sessionFactory;

    public function __construct(CheckoutSession $checkoutSession, CollectionFactory $collectionFactory, SessionFactory $sessionFactory)
    {
        $this->checkoutSession = $checkoutSession;
        $this->collectionFactory = $collectionFactory;
        $this->sessionFactory = $sessionFactory;
    }

    public function execute(Observer $observer)
    {

        $item = $observer->getEvent()->getQuoteItem();
        $product = $item->getProduct();
        $originalPrice = $product->getFinalPrice();
        $session = $this->sessionFactory->create();
        $customerGroupId = null;

        if ($session->isLoggedIn()) {
            $customer = $session->getCustomer();
            $customerGroupId = $customer->getGroupId();
        }

        $collection = $this->collectionFactory->create();
        $productIds = $collection->getColumnValues('product_ids');
        $discountRate = $collection->getColumnValues('discount_amount');
        $startTime = $collection->getColumnValues('start_time');
        $endTime = $collection->getColumnValues('end_time');
        $priority = $collection->getColumnValues('priority');
        $customerGroupIds = $collection->getColumnValues('customer_group_ids');
        $active = $collection->getColumnValues('is_active');
        $currentTime = date('Y-m-d H:i:s');

        foreach ($productIds as $key => $productId) {
            if ($product->getId() == $productId
                && $currentTime >= $startTime[$key] && $currentTime <= $endTime[$key]
                && in_array($customerGroupId, explode(',', $customerGroupIds[$key]))
                && $active[$key] == 1
                && $this->isHigherPriority($productIds, $priority, $key)
            ) {
                $discountedPrice = $this->applyDiscount($originalPrice, $discountRate[$key] / 100);
//                set lai tong gia trong cart
                $item->setCustomPrice($discountedPrice);
                $item->setOriginalCustomPrice($originalPrice);
                $item->getProduct()->setIsSuperMode(false);
//                $item->save();
//                $item->getQuote()->collectTotals();
                break;
            }
        }
    }

    protected function applyDiscount($price, $discountRate)
    {
        return $price - ($price * $discountRate);
    }

    protected function isHigherPriority($productIds, $priority, $key)
    {
        foreach ($productIds as $i => $id) {
            if ($productIds[$i] == $productIds[$key] && $priority[$i] < $priority[$key]) {
                return false;
            }
        }
        return true;
    }
}
