<?php

namespace Tigren\Testimonial\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Tigren\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory;

class TestimonialViewModel implements ArgumentInterface
{
    protected $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function getTestimonials()
    {
        $data = [];
        $collections = $this->collectionFactory->create();
        foreach ($collections as $collection) {
            $data = $collection->addFieldToSelect(['name', 'email', 'message', 'created_at']);
        }
//        $collection->addFieldToSelect(['name', 'email', 'message', 'created_at']);
        return $data;
    }
}
