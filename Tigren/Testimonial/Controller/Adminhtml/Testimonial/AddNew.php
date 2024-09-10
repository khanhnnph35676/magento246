<?php

namespace Tigren\Testimonial\Controller\Adminhtml\Testimonial;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class AddNew extends Action
{

    public function execute()
    {
//        $data = $this->getRequest()->getPostValue();
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $id = $this->getRequest()->getParam('entity_id');
        if (isset($id)) {
            $resultPage->getConfig()->getTitle()->prepend(__('Update Testimonial'));
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('Add New Testimonial'));
        }
        return $resultPage;
    }
}
