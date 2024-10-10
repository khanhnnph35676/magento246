<?php

namespace Tigren\Testimonial\Model\Resolver\DataProvider;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\Exception\LocalizedException;

class Testimonial
{
    protected $_factory;

    protected $_objectManager;

    public function __construct(
        \Tigren\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory $factory,
        \Magento\Framework\ObjectManagerInterface                             $objectManager
    )
    {
        $this->_factory = $factory;
        $this->_objectManager = $objectManager;
    }

    public function getData()
    {
        $data = [];
        try {
            $collection = $this->_factory->create();
            $data = $collection->getData();

        } catch (NoSuchEntityException $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
        }
        return $data;
    }

    public function insertTestimonial($data)
    {
        if (!is_array($data)) {
            throw new LocalizedException(__('Invalid data format.'));
        }
        try {
            $testimonial = $this->_objectManager->create('Tigren\Testimonial\Model\Testimonial');
            $testimonial->setData($data)->save();
            return ['message' => 'Success'];
        } catch (\Exception $e) {
            throw new LocalizedException(__('Unable to save testimonial: ' . $e->getMessage()));
        }
    }
}
