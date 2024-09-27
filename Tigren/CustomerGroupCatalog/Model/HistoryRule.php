<?php

namespace Tigren\CustomerGroupCatalog\Model;
class HistoryRule extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Tigren\CustomerGroupCatalog\Model\ResourceModel\HistoryRule');
    }

    public function getEntityId()
    {
        return $this->getData('entity_id');
    }

    public function setEntityId($entityId)
    {
        return $this->setData('entity_id', $entityId);
    }

    public function getOrderId()
    {
        return $this->getData('order_id');
    }

    public function setOrderId($orderId)
    {
        return $this->setData('order_id', $orderId);
    }

    public function getCustomerId()
    {
        return $this->getData('customer_id');
    }

    public function setCustomerId($customerId)
    {
        return $this->setData('customer_id', $customerId);
    }

    public function getRuleId()
    {
        return $this->getData('rule_id');
    }

    public function setRuleId($ruleId)
    {
        return $this->setData('rule_id', $ruleId);
    }

    public function getCreatedAt()
    {
        return $this->getData('created_at');
    }

    public function setCreatedAt($createdAt)
    {
        return $this->setData('created_at', $createdAt);
    }
}
