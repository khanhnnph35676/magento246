<?php

namespace Tigren\HidePrice\Plugin\Catalog\Product;

use Magento\Catalog\Model\Product as ProductPrice;
use Magento\Customer\Model\SessionFactory;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\CustomerGroupCatalog\CollectionFactory;


/**
 * Hide Price Plugin
 */
class HidePrice
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
        $this->sessionFactory = $sessionFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param ProductPrice $subject
     * @param \Closure $proceed
     * @return \Magento\Framework\Phrase|mixed|null
     */
    public function aroundGetPrice(ProductPrice $subject, \Closure $proceed)
    {
        // Lấy session của khách hàng
        $session = $this->sessionFactory->create();

        // Kiểm tra khách hàng có đăng nhập hay không
        if (!$session->isLoggedIn()) {
            return null;  // Nếu chưa đăng nhập thì không hiển thị giá
        }
//        else {
//            // Lấy ID sản phẩm từ đối tượng sản phẩm $subject
//            $productId = $subject->getId();
//            $customerGroupId = $session->getCustomerGroupId(); // Lấy ID nhóm khách hàng
//
//            // Lấy danh sách các quy tắc áp dụng cho sản phẩm và nhóm khách hàng
//            $ruleCollection = $this->collectionFactory->create();
//            $ruleCollection->addFieldToFilter('product_ids', ['finset' => $productId])
//                ->addFieldToFilter('customer_group_ids', ['finset' => $customerGroupId])
//                ->addFieldToFilter('start_time', ['lteq' => date('Y-m-d H:i:s')])
//                ->addFieldToFilter('end_time', ['gteq' => date('Y-m-d H:i:s')])
//                ->addFieldToFilter('is_active', 1)
//                ->setOrder('priority', 'ASC');
//
//            $rule = $ruleCollection->getFirstItem();
//
//            // Nếu tìm thấy quy tắc phù hợp
//            if ($rule->getId() && $this->isRuleValid($rule, $subject)) {
//                $discountValue = $this->computeDiscount($rule, $subject->getPrice());
//
//                if ($discountValue > 0) {
//                    $finalPrice = $subject->getPrice() - $discountValue;
//                    // Thiết lập giá sau khi giảm
//                    return $subject->setFinalPrice($finalPrice);
//                }
//            }
//        }
        // Trả về giá xử lý bởi phương thức gốc
        return $proceed();
    }

    protected function isRuleValid($rule, $cartItem)
    {
        return true;
    }

    /**
     * @param $rule
     * @param $basePrice
     * @return float|int
     */
    protected function computeDiscount($rule, $basePrice)
    {
        $discountRate = $rule->getDiscountAmount();

        if ($discountRate <= 0) {
            return 0;
        }
        return ($basePrice * $discountRate) / 100;
    }
}
