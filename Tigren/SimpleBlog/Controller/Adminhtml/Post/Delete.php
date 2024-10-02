<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

namespace Tigren\SimpleBlog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Tigren\SimpleBlog\Model\ResourceModel\Post\CollectionFactory;
use Tigren\SimpleBlog\Model\PostFactory;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Backend\Model\View\Result\RedirectFactory;

/**
 *Class delete Post
 */
class Delete extends Action implements ButtonProviderInterface
{
    /**
     * @var PostFactory
     */
    private $postFactory;
    /**
     * @var Filter
     */
    private $filter;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var RedirectFactory
     */
    private $resultRedirect;

    /**
     * @param Action\Context $context
     * @param PostFactory $postFactory
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param RedirectFactory $resultRedirect
     */
    public function __construct(
        Action\Context    $context,
        PostFactory       $postFactory,
        Filter            $filter,
        CollectionFactory $collectionFactory,
        RedirectFactory   $resultRedirect
    )
    {
        parent::__construct($context);
        $this->postFactory = $postFactory;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->resultRedirect = $resultRedirect;
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirect->create();
        $id = $this->getRequest()->getParam('post_id');
        try {
            $model = $this->postFactory->create()->load($id);
            $model->delete();
            $this->messageManager->addSuccessMessage(__('You have deleted the post.'));
            return $resultRedirect->setPath('*/*/index');
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the question.'));
        }
    }

    /**
     * @return array|void
     */
    public function getButtonData()
    {
        $id = $this->getRequest()->getParam('post_id');
        if (!empty($id)) {
            return [
                'label' => __('Delete Post'),
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
