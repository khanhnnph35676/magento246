<?php

namespace Tigren\CustomerGroupCatalog\Model\ResourceModel\HistoryRule;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\HistoryRule as HistoryRuleResource;
use Tigren\CustomerGroupCatalog\Model\HistoryRule as HistoryRuleModel;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(
            HistoryRuleModel::class,
            HistoryRuleResource::class
        );
    }
}
