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
            'priority' => $data['priority'],
            'discount_amount' => $data['discount_amount'],
            'is_active' => $data['is_active'],
            'customer_group_ids' => $data['customer_group_ids'],
            'store_id' => $data['store_id'],
            'product_ids' => $data['product_ids'],
        ];

        $rule = $this->ruleFactory->create();
        $collection = $this->colectionFactory->create();
        $listRule = $collection->getData();

        if (isset($id)) {
            $rule->load($id);
        }

        try {
            // Kiểm tra và lưu từng giá trị cho customer group, store và product
            $customerGroupIds = $data['customer_group_ids'] ?? [];
            $storeIds = $data['store_id'] ?? [];
            $productIds = $data['product_ids'] ?? [];

            // Lưu khi chỉ có một customer group
            if (count($customerGroupIds) <= 1 && count($storeIds) <= 1 && count($productIds) <= 1) {
                $newData['customer_group_ids'] = $customerGroupIds[0] ?? '';
                $newData['store_id'] = $storeIds[0] ?? '';// Ghép các store lại thành chuỗi
                $newData['product_ids'] = $productIds[0] ?? ''; // Ghép các product lại thành chuỗi
                $rule->addData($newData);
                $rule->save();
            }

            // Lưu cho nhiều customer group
            if (count($customerGroupIds) > 1 || count($storeIds) > 1 || count($productIds) > 1) {
                foreach ($customerGroupIds as $groupId) {
                    foreach ($storeIds as $storeId) {
                        foreach ($productIds as $productId) {
                            // Kiểm tra xem đã tồn tại rule với customer group và name hay chưa
                            $exists = false;
                            foreach ($listRule as $existingRule) {
                                if ($existingRule['customer_group_ids'] == $groupId
                                    && $existingRule['store_id'] == $storeId
                                    && $existingRule['product_ids'] == $productId) {
                                    $exists = true;
                                    break;
                                }
                            }
                            // Nếu chưa tồn tại, tạo mới
                            if (!$exists) {
                                $newData['customer_group_ids'] = $groupId;
                                $newData['store_id'] = $storeId;
                                $newData['product_ids'] = $productId;
                                $newRule = clone $rule;
                                $newRule->setId(null); // Đảm bảo ID là null để tạo bản ghi mới
                                $newRule->addData($newData);
                                $newRule->save(); // Lưu bản ghi mới
                            }
                        }
                    }
                }
            }

            $this->messageManager->addSuccessMessage(__('You saved the Customer Group Catalog.'));
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__($exception->getMessage()));
        }
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
