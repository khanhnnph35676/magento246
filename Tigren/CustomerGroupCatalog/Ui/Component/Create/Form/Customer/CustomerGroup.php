<?php

namespace Tigren\CustomerGroupCatalog\Ui\Component\Create\Form\Customer;

use Magento\Customer\Model\ResourceModel\Group\CollectionFactory as CustomerGroupCollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Data\OptionSourceInterface;

class CustomerOptions implements OptionSourceInterface
{
    protected $customerGroupCollectionFactory;
    protected $request;

    public function __construct(
        CustomerGroupCollectionFactory $customerGroupCollectionFactory,
        RequestInterface               $request
    )
    {
        $this->customerGroupCollectionFactory = $customerGroupCollectionFactory;
        $this->request = $request;
    }

    public function toOptionArray()
    {
        return $this->getCustomerGroupOptions();
    }

    protected function getCustomerGroupOptions()
    {
        $options = [];
        $collection = $this->customerGroupCollectionFactory->create();
        $collection->addFieldToSelect(['customer_group_id', 'customer_group_code']);

        foreach ($collection as $group) {
            $options[] = [
                'value' => $group->getCustomerGroupId(),
                'label' => $group->getCustomerGroupCode()
            ];
        }

        if (empty($options)) {
            $options[] = [
                'label' => 'No customer groups found',
                'value' => ''
            ];
        }

        return $options;
    }
}
