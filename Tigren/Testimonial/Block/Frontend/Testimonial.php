<?php

namespace Tigren\Testimonial\Block\Frontend;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Testimonial extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory    $resultPageFactory,
    )
    {
        $this->$resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}
