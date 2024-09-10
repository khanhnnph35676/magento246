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

//        $data = $this->testimonialFactory->create()->getCollection();
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);


//        foreach ($data as $value) {
//            echo "<pre>";
//            print_r($value->getData());
//            echo $value->getName();
//            $value->getEmail();
//            $value->getMessage();
//            $value->getCompany();
//            $value->getRating();
//            $value->getProfileImage();
//            $value->getStatus();
//            $value->getCreatedAt();
//
//            echo "</pre>";
//        }
    }
}

