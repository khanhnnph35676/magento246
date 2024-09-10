<?php

namespace Tigren\Testimonial\Model\ResourceModel\Testimonial;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Tigren\Testimonial\Model\Testimonial as TestimonialModel;
use Tigren\Testimonial\Model\ResourceModel\Testimonial as TestimonialResource;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(
            TestimonialModel::class,
            TestimonialResource::class
        );
    }
}
