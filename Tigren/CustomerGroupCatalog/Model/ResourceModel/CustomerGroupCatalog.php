<?php


namespace Tigren\CustomerGroupCatalog\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CustomerGroupCatalog extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('customer_group_catalog_rule', 'rule_id');
    }

}
