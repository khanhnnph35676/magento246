<?php

namespace Tigren\Testimonial\Controller\Testimonial;

use Magento\Framework\Controller\ResultFactory;

class Create extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_PAGE);
    }
}

