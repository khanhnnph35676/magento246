<?php

/**
 * Created By : RH
 */

namespace Tigren\CustomerGroupCatalog\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\View\LayoutFactory;

class Grids extends Action
{

    /**
     * @var \Magento\Framework\Controller\Result\RawFactory
     */
    protected $resultRawFactory;

    /**
     * @var \Magento\Framework\View\LayoutFactory
     */
    protected $layoutFactory;

    /**
     * @param Context $context
     * @param Rawfactory $resultRawFactory
     * @param LayoutFactory $layoutFactory
     */
    public function __construct(
        Context       $context,
        Rawfactory    $resultRawFactory,
        LayoutFactory $layoutFactory
    )
    {
        parent::__construct($context);
        $this->resultRawFactory = $resultRawFactory;
        $this->layoutFactory = $layoutFactory;
    }

    /**
     * @return \Magento\Framework\Controller\Result\Raw
     */
    public function execute()
    {
        $resultRaw = $this->resultRawFactory->create();
        return $resultRaw->setContents(
            $this->layoutFactory->create()->createBlock(
                'Tigren\CustomerGroupCatalog\Block\Adminhtml\Tab\Productgrid',
                'customer_group_catalog.custom.tab.productgrid'
            )->toHtml()
        );
    }
}
