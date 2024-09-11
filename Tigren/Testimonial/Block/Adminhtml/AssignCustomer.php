<?php

namespace Tigren\Testimonial\Block\Adminhtml;

class AssignCustomer extends \Magento\Backend\Block\Template
{
    /**
     * Block template
     * @var string
     */
    protected $_template = 'testimonial/assign_customer.phtml';

    /**
     * @var \Magento\Customer\Block\Adminhtml\Grid\Filter\Country
     */
    protected $blockGrid;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;
    /**
     * @var \Magento\Framework\Json\EncoderInterface
     */
    protected $jsonEncoder;

    /**
     * @var \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory
     */
    protected $customerFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerFactory
     */
    public function __construct
    (
        \Magento\Backend\Block\Template\Context                          $context,
        \Magento\Framework\Registry                                      $registry,
        \Magento\Framework\Json\EncoderInterface                         $jsonEncoder,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerFactory,
    )
    {
        $this->registry = $registry;
        $this->jsonEncoder = $jsonEncoder;
        $this->customerFactory = $customerFactory;
        parent::__construct($context);
    }

    public function getBlockGrid()
    {
        $this->blockGrid = $this->getLayout()->createBlock(
            'Tigren\Testimonial\Block\Adminhtml\Tab\CustomerGrid',
            'customer_grid',
        );
        return $this->blockGrid;
    }

    public function getCustomerJson()
    {
        $entity_id = $this->getRequest()->getParam('entity_id');
        $customerFactory = $this->customerFactory->create();
        $customerFactory->addFieldToSelect(['entity_id', 'position']);
        $customerFactory->addFieldToFilter('entity_id', ['eq' => $entity_id]);
        $result = [];
        if (!empty($customerFactory->getData())) {
            foreach ($customerFactory->getData() as $customer) {
                $result[$customer['entity_id']] = '';
            }
            return $this->jsonEncoder->encode($result);
        }
        return '{}';
    }

    public function getItem()
    {
        return $this->registry->registry('my_item');
    }
}
