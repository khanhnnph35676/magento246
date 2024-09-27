<?php

namespace Tigren\Testimonial\Block;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\Template;
use Tigren\Testimonial\Model\ResourceModel\Testimonial\Collection as TestimonialCollection;
use Tigren\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory;
use Magento\Store\Model\ScopeInterface;

class TestimonialList extends Template
{

    /**
     * Testimonial Collection
     * @var TestimonialCollection
     */
    protected $_testimonialCollection;

    /**
     * Testimonial resource model
     * @var \Tigren\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory
     */
    protected $_testimonialCollectionFactory;


    /**
     * @param Template\Context $context
     * @param CollectionFactory $collectionFactory
     * @param array $data
     * @SuppressWarnings (PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Template\Context  $context,
        CollectionFactory $collectionFactory,
        array             $data = []
    )
    {
        $this->_testimonialCollectionFactory = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * Get Demo Items Collection
     * @return \Tigren\Testimonial\Model\ResourceModel\Testimonial\Collection
     */

    public function getTestimonialItem()
    {
        if ($this->_testimonialCollection === null) {
            $this->_testimonialCollection = $this->_testimonialCollectionFactory->create();
        }
        return $this->_testimonialCollection;
    }
}
