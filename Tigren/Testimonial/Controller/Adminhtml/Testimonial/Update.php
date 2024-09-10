<?php

namespace Tigren\Testimonial\Controller\Adminhtml\Testimonial;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Update extends Action
{
    public function __construct(
        Action\Context $context,
    )
    {
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        if (isset($id)) {
            $resultPage->getConfig()->getTitle()->prepend(__('Update Testimonial'));
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('Add New Testimonial'));
        }
        return $resultPage;
    }
}
