<?php

namespace Tigren\CustomerGroupCatalog\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Form extends Action
{

    public function execute()
    {
//        $data = $this->getRequest()->getPostValue();
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $id = $this->getRequest()->getParam('rule_id');
        if (isset($id)) {
            $resultPage->getConfig()->getTitle()->prepend(__('Update Customer Group'));
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('Add New Customer Group'));
        }
        return $resultPage;
    }
}
