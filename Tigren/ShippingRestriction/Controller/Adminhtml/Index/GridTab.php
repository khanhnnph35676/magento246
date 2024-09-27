<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

declare(strict_types=1);

namespace Tigren\ShippingRestriction\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class GridTab extends \Magento\Backend\App\Action

{
    /**
     * Page return
     *
     * @var PageFactory
     */
    protected $_pageFactory;

    /**
     * Execute function
     *
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context        $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * Page return
     *
     * @return mixed
     */
    public function execute()
    {
        $resultPage = $this->_pageFactory->create();
        $id = $this->getRequest()->getParam('entity_id');
        $resultPage->setActiveMenu("Tigren_ShippingRestriction::shipping_restriction");
        if (isset($id)) {
            $resultPage
                ->getConfig()
                ->getTitle()
                ->prepend(__("Update Shipping Restriction Rules"));
        } else {
            $resultPage
                ->getConfig()
                ->getTitle()
                ->prepend(__("Add Shipping Restriction Rules"));
        }
        return $resultPage;
    }
}
