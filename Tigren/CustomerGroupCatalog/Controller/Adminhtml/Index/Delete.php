<?php

namespace Tigren\CustomerGroupCatalog\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Tigren\CustomerGroupCatalog\Model\ResourceModel\CustomerGroupCatalog\CollectionFactory;
use Tigren\CustomerGroupCatalog\Model\CustomerGroupCatalogFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Delete extends Action implements ButtonProviderInterface
{
    private $customerGroupCatalogFactory;
    private $filter;
    private $collectionFactory;
    private $resultRedirect;

    public function __construct(
        Action\Context              $context,
        CustomerGroupCatalogFactory $customerGroupCatalogFactory,
        Filter                      $filter,
        CollectionFactory           $collectionFactory,
        RedirectFactory             $resultRedirect
    )
    {
        parent::__construct($context);
        $this->customerGroupCatalogFactory = $customerGroupCatalogFactory;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->resultRedirect = $resultRedirect;
    }

    public function execute()
    {
//        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $resultRedirect = $this->resultRedirect->create();
        $id = $this->getRequest()->getParam('rule_id');
        try {
            $model = $this->customerGroupCatalogFactory->create()->load($id);
            $model->delete();
            $this->messageManager->addSuccessMessage(__('You have deleted the testimonial.'));
            return $resultRedirect->setPath('customer_group_catalog/index/index');
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the question.'));
        }
    }

    public function getButtonData()
    {
        $id = $this->getRequest()->getParam('rule_id');
        if (!empty($id)) {
            return [
                'label' => __('Delete Customer Group Catalog'),
                'class' => 'delete primary',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'delete']],
                    'form-role' => 'delete',
                ],
                'sort_order' => 90,
            ];
        }
    }
}
