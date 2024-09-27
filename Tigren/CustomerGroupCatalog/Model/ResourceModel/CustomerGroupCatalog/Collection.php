<?php

namespace Tigren\CustomerGroupCatalog\Model\ResourceModel\CustomerGroupCatalog;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\CustomerGroupCatalog as CustomerGroupCatalogResource;
use Tigren\CustomerGroupCatalog\Model\CustomerGroupCatalog as CustomerGroupCatalogModel;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'rule_id';

    protected function _construct()
    {
        $this->_init(
            CustomerGroupCatalogModel::class,
            CustomerGroupCatalogResource::class
        );
    }
}
