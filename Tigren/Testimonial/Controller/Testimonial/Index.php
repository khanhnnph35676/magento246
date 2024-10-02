<?php

namespace Tigren\Testimonial\Controller\Testimonial;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $testimonialFactory;

    public function __construct(\Magento\Framework\App\Action\Context        $context,
                                \Tigren\Testimonial\Model\TestimonialFactory $testimonialFactory)

    {
        $this->testimonialFactory = $testimonialFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}

