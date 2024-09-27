<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */


namespace Tigren\SimpleBlog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Form extends Action
{
    protected $pageFactory;

    public function __construct(Action\Context $context, PageFactory $pageFactory)
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('post');
        $resultPage = $this->pageFactory->create();
        if ($id) {
            $resultPage->getConfig()->getTitle()->prepend(__('Update new blog post'));
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('Add new blog post'));
        }

        return $resultPage;
    }
}


