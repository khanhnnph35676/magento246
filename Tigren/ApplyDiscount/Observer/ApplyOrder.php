<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

namespace Tigren\ApplyDiscount\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\CustomerGroupCatalog\CollectionFactory as CustomerGroupCatalogCollectionFactory;
use Tigren\CustomerGroupCatalog\Model\HistoryRuleFactory;

/**
 * Apply order plade
 */
class ApplyOrder implements ObserverInterface
{
    /**
     * @param LoggerInterface $logger
     */
    protected LoggerInterface $logger;

    /**
     * @var CustomerGroupCatalogCollectionFactory
     */
    protected CustomerGroupCatalogCollectionFactory $CollectionFactory;

    /**
     * @param HistoryRuleFactory $RuleHistoryFactory
     */
    protected HistoryRuleFactory $RuleHistoryFactory;

    public function __construct(
        LoggerInterface                       $logger,
        CustomerGroupCatalogCollectionFactory $CollectionFactory,
        HistoryRuleFactory                    $RuleHistoryFactory
    )
    {
        $this->logger = $logger;
        $this->CollectionFactory = $CollectionFactory;
        $this->RuleHistoryFactory = $RuleHistoryFactory;
    }

    /**
     * @param Observer $observer
     * @return null
     */

    /**
     * @param Observer $observer
     * @return void
     */
    protected function getRuleId($order)
    {
        $productIds = [];
        // Lấy tất cả các sản phẩm trong đơn hàng
        $itemCollection = $order->getAllItems();
        foreach ($itemCollection as $item) {
            $productIds[] = $item->getProductId();
        }
        // Lấy Customer Group ID từ Order
        $customerGroupId = $order->getCustomerGroupId();

        $this->logger->info("Input Product IDs: " . implode(',', $productIds));
        $this->logger->info("Input Customer Group ID: " . $customerGroupId);

        $ruleCollection = $this->CollectionFactory->create();

        $ruleCollection->addFieldToFilter('product_ids', ['finset' => implode(',', $productIds)])
            ->addFieldToFilter('customer_group_ids', ['finset' => $customerGroupId])
            ->addFieldToFilter('start_time', ['lteq' => date('Y-m-d H:i:s')])
            ->addFieldToFilter('end_time', ['gteq' => date('Y-m-d H:i:s')])
            ->addFieldToFilter('is_active', 1)
            ->setOrder('priority', 'ASC');

        // Ghi lại số lượng quy tắc tìm thấy
        $this->logger->info("Rule Collection Count: " . $ruleCollection->getSize());

        if ($ruleCollection->getSize() > 0) {
            // Lấy rule ID đầu tiên tìm thấy
            $rule = $ruleCollection->getFirstItem();
            $ruleId = $rule->getId();
            $this->logger->info("Found Rule ID: " . $ruleId);

//            // Giả sử bạn có đối tượng đơn hàng là $order
            $order->setData('rule_id', $ruleId); // Lưu rule ID vào trường dữ liệu của đơn hàng
            $order->save(); // Lưu đơn hàng

            return $ruleId; // Trả về rule ID đã tìm thấy
        }

        return null; // Không tìm thấy rule ID
    }

    public function execute(Observer $observer)
    {
        $this->logger->info('Observer applied successfully');

        $orderItem = $observer->getEvent()->getOrder();
        $ruleId = $this->getRuleId($orderItem);

        if (!$orderItem || !$orderItem->getEntityId()) {
            $this->logger->error("Order object is null or Order ID is invalid.");
            return;
        }
        $customerId = $orderItem->getCustomerId(); // Lấy Customer ID
        $orderId = $orderItem->getEntityId(); // Lấy Order ID

        // Kiểm tra xem Order ID có hợp lệ không
        if (!$orderId) {
            $this->logger->error("Order ID is empty or invalid.");
            return;
        }

        $history = $this->RuleHistoryFactory->create();
        if ($ruleId) {
            $history->load($ruleId);
            $newData = [
                'customer_id' => $customerId,
                'order_id' => $orderId,
                'rule_id' => $ruleId,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            $history->addData($newData);
            $history->save();
            $this->logger->info("Successfully saved rule history for Rule ID: " . $ruleId);
        }
        $this->logger->error("Failed to save rule history: ");
    }
}
