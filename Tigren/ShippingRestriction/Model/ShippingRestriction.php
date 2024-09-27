<?php


namespace Tigren\ShippingRestriction\Model;

use Magento\Framework\Model\AbstractModel;

class ShippingRestriction extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Tigren\ShippingRestriction\Model\ResourceModel\ShippingRestriction');
    }

}
