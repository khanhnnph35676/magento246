<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

namespace Tigren\SimpleBlog\Controller\Adminhtml\Post;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Tigren\SimpleBlog\Model\PostFactory;
use Magento\Backend\App\Action;
use Magento\Customer\Api\CustomerRepositoryInterface;

/**
 * Class Save
 * @package Tigren\Testimonial\Controller\Adminhtml\Testimonial
 */
class Save extends Action implements ButtonProviderInterface
{
    /**
     * @var PostFactory
     */
    private $postFactory;
    protected $customerSession;
    protected $customerRepository;

    /**
     * Save constructor
     * @param Action\Context $context
     * @param PostFactory $postFactory
     */
    public function __construct(
        Action\Context              $context,
        PostFactory                 $postFactory,
        CustomerRepositoryInterface $customerRepository
    )
    {
        parent::__construct($context);
        $this->postFactory = $postFactory;
        $this->customerRepository = $customerRepository;
    }

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
        if (!empty($data['post_image'][0]['name']) && isset($data['post_image'][0]['id'])) {
            $data['post_image'][0] = $data['post_image'][0]['name'];
        } else {
            unset($data['post_image']);
        }

        $id = !empty($data['post_id']) ? $data['post_id'] : null;
        $image = isset($data['post_image']) ? $data['post_image'][0] : null;
        $newData = [
            'status' => $data['status'],
            'title' => $data['title'],
            'short_content' => $data['short_content'],
            'full_content' => $data['full_content'],
            'published_at' => $data['published_at'],
            'post_image' => $image,
            'author' => $data['author'],
            'category_id' => $data['category_id'],
        ];
//        var_dump($newData);
//        dd();
        $post = $this->postFactory->create();
        if (isset($id)) {
            $post->load($id);
        }
        try {
            $post->addData($newData);
            $post->save();
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__($exception->getMessage()));
        }
        $this->messageManager->addSuccessMessage(__('You saves the Post.'));
        return $resultRedirect->setPath('*/*/index');
    }

    public function getButtonData()
    {
        return [
            'label' => __('Save Post'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
