<?php

namespace Tigren\Testimonial\Block\Adminhtml\Tab;
class CustomerGrid extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry = null;
    /**
     * @var \Magento\Customer\Model\CustomerFactory;
     */
    protected $customerFactory;
    /**
     * @var \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory
     */
    protected $customerColFactory;

    public function __construct
    (
        \Magento\Backend\Block\Template\Context                          $context,
        \Magento\Backend\Helper\Data                                     $backendHelper,
        \Magento\Catalog\Model\CustomerFactory                           $customerFactory,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerColFactory,
        \Magento\Framework\Registry                                      $coreRegistry,
        \Magento\Framework\Module\Manager                                $moduleManager,
        \Magento\Store\Model\StoreManagerInterface                       $storeManager,
//        Visibility                                                       $visibility = null,
        array                                                            $data = []
    )
    {
        $this->customerFactory = $customerFactory;
        $this->customerColFactory = $customerColFactory;
        $this->coreRegistry = $coreRegistry;
        $this->moduleManager = $moduleManager;
        $this->storeManager = $storeManager;
        parent::__construct($context, $backendHelper, $data);
    }

}
