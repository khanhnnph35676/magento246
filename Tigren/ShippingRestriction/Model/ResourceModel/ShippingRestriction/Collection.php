<?php

namespace Tigren\ShippingRestriction\Model\ResourceModel\ShippingRestriction;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Tigren\ShippingRestriction\Model\ResourceModel\ShippingRestriction as ShippingRestrictionResource;
use Tigren\ShippingRestriction\Model\ShippingRestriction as ShippingRestrictionModel;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(
            ShippingRestrictionModel::class,
            ShippingRestrictionResource::class
        );
    }
}
