<?php

namespace Tigren\Testimonial\Controller\Adminhtml\Testimonial;

use Magento\Backend\App\Action;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Tigren\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory;
use Tigren\Testimonial\Model\TestimonialFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Backend\Model\View\Result\RedirectFactory;

class Delete extends Action implements ButtonProviderInterface
{
    private $testimonialFactory;
    private $filter;
    private $collectionFactory;
    private $resultRedirect;

    public function __construct(
        Action\Context     $context,
        TestimonialFactory $testimonialFactory,
        Filter             $filter,
        CollectionFactory  $collectionFactory,
        RedirectFactory    $resultRedirect
    )
    {
        parent::__construct($context);
        $this->testimonialFactory = $testimonialFactory;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->resultRedirect = $resultRedirect;
    }

    public function execute()
    {
//        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $resultRedirect = $this->resultRedirect->create();
        $id = $this->getRequest()->getParam('entity_id');
        try {
            $model = $this->testimonialFactory->create()->load($id);
            $model->delete();
            $this->messageManager->addSuccessMessage(__('You have deleted the testimonial.'));
            return $resultRedirect->setPath('*/*/index');
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the question.'));
        }
    }

    public function getButtonData()
    {
        $id = $this->getRequest()->getParam('entity_id');
        if (!empty($id)) {
            return [
                'label' => __('Delete Testimonial'),
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
