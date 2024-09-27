<?php

namespace Tigren\CustomerGroupCatalog\Model;
class CustomerGroupCatalog extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Tigren\CustomerGroupCatalog\Model\ResourceModel\CustomerGroupCatalog');
    }

    public function getRuleId()
    {
        return $this->getData('rule_id');
    }

    public function setRuleId($ruleId)
    {
        return $this->setData('rule_id', $ruleId);
    }

    // Getter và Setter cho 'name'
    public function getName()
    {
        return $this->getData('name');
    }

    public function setName($name)
    {
        return $this->setData('name', $name);
    }

    // Getter và Setter cho 'customer_group_ids'
    public function getCustomerGroupIds()
    {
        return $this->getData('customer_group_ids');
    }

    public function setCustomerGroupIds($customerGroupIds)
    {
        return $this->setData('customer_group_ids', $customerGroupIds);
    }

    // Getter và Setter cho 'store_id'
    public function getStoreId()
    {
        return $this->getData('store_id');
    }

    public function setStoreId($storeId)
    {
        return $this->setData('store_id', $storeId);
    }

    // Getter và Setter cho 'product_ids'
    public function getProductIds()
    {
        return $this->getData('product_ids');
    }

    public function setProductIds($productIds)
    {
        return $this->setData('product_ids', $productIds);
    }

    // Getter và Setter cho 'discount_amount'
    public function getDiscountAmount()
    {
        return $this->getData('discount_amount');
    }

    public function setDiscountAmount($discountAmount)
    {
        return $this->setData('discount_amount', $discountAmount);
    }

    // Getter và Setter cho 'start_time'
    public function getStartTime()
    {
        return $this->getData('start_time');
    }

    public function setStartTime($startTime)
    {
        return $this->setData('start_time', $startTime);
    }

    // Getter và Setter cho 'end_time'
    public function getEndTime()
    {
        return $this->getData('end_time');
    }

    public function setEndTime($endTime)
    {
        return $this->setData('end_time', $endTime);
    }

    // Getter và Setter cho 'priority'
    public function getPriority()
    {
        return $this->getData('priority');
    }

    public function setPriority($priority)
    {
        return $this->setData('priority', $priority);
    }

    // Getter và Setter cho 'is_active'
    public function getIsActive()
    {
        return $this->getData('is_active');
    }

    public function setIsActive($isActive)
    {
        return $this->setData('is_active', $isActive);
    }
}
