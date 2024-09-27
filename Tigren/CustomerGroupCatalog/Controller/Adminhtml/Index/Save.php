<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

namespace Tigren\CustomerGroupCatalog\Controller\Adminhtml\Index;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Tigren\CustomerGroupCatalog\Model\CustomerGroupCatalogFactory;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\CustomerGroupCatalog\CollectionFactory;
use Magento\Backend\App\Action;
use Tigren\CustomerGroupCatalog\Block\Adminhtml\Tab\CustomerGroupGrid;

/**
 *
 */
class Save extends Action implements ButtonProviderInterface
{
    /**
     * @var CustomerGroupCatalogFactory
     */
    private $ruleFactory;
    /**
     * @var CollectionFactory
     */
    private $colectionFactory;

    /**
     * @param Action\Context $context
     * @param CustomerGroupCatalogFactory $ruleFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Action\Context              $context,
        CustomerGroupCatalogFactory $ruleFactory,
        CollectionFactory           $collectionFactory
    )
    {
        parent::__construct($context);
        $this->ruleFactory = $ruleFactory;
        $this->colectionFactory = $collectionFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->messageManager->addErrorMessage(__('No data found to save.'));
            return $resultRedirect->setPath('*/*/');
        }
//        var_dump($data);
//        dd();
        $id = !empty($data['rule_id']) ? $data['rule_id'] : null;
        $newData = [
            'name' => $data['name'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'customer_group_ids' => '',
            'priority' => $data['priority'],
            'discount_amount' => $data['discount_amount'],
            'is_active' => $data['is_active'],
        ];
        $rule = $this->ruleFactory->create();
        $collection = $this->colectionFactory->create();
        $listRule = $collection->getData();
//        var_dump($listRule);
//        dd();
        if (isset($id)) {
            $rule->load($id);
        }
        try {
            if (count($data['customer_group_ids']) <= 1) {
                $newData['customer_group_ids'] = $data['customer_group_ids'][0];
                $rule->addData($newData);
                $rule->save();
            }
            if (count($data['customer_group_ids']) > 1) {
                foreach ($data['customer_group_ids'] as $key => $value) {
                    $exists = false;
                    foreach ($listRule as $key => $existingRule) {
                        if ($existingRule['customer_group_ids'] == $value && $existingRule['name'] == $data['name']) {
                            $exists = true;
                            break;
                        }
                    }
                    if (!$exists) {
                        $newData = ['customer_group_ids' => $value];
                        $newRule = clone $rule;
                        $newRule->setId(null); // Đảm bảo ID là null để tạo bản ghi mới
                        $newRule->addData($newData); // Thêm dữ liệu mới
                        $newRule->save(); // Lưu bản ghi mới
                    }
                }
            }
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__($exception->getMessage()));
        }
        $this->messageManager->addSuccessMessage(__('You saves the Customer Group Catalog.'));
        return $resultRedirect->setPath('*/*/index');
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
