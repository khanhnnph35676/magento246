<?php


namespace Tigren\ShippingRestriction\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ShippingRestriction extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('shipping_restrictions', 'entity_id');
    }

}
