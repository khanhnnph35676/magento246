<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

namespace Tigren\SimpleBlog\Controller\Adminhtml\Category;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Tigren\SimpleBlog\Model\CategoryFactory;
use Magento\Backend\App\Action;
use Magento\Customer\Api\CustomerRepositoryInterface;

/**
 * Class Save
 * @package Tigren\Testimonial\Controller\Adminhtml\Testimonial
 */
class Save extends Action implements ButtonProviderInterface
{
    /**
     * @var CategoryFactory
     */
    private $categoryFactory;
    protected $customerSession;
    protected $customerRepository;

    /**
     * Save constructor
     * @param Action\Context $context
     * @param PostFactory $postFactory
     */
    public function __construct(
        Action\Context              $context,
        CategoryFactory             $categoryFactory,
        CustomerRepositoryInterface $customerRepository
    )
    {
        parent::__construct($context);
        $this->categoryFactory = $categoryFactory;
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

        $id = !empty($data['category_id']) ? $data['category_id'] : null;
        $newData = [
            'status' => $data['status'],
            'name' => $data['name'],
            'description' => $data['description'],
            'created_at' => $data['created_at'],
            'updated_at' => $data['updated_at'],
        ];
//        var_dump($newData);
//        dd();
        $category = $this->categoryFactory->create();
        if (isset($id)) {
            $category->load($id);
        }
        try {
            $category->addData($newData);
            $category->save();
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__($exception->getMessage()));
        }
        $this->messageManager->addSuccessMessage(__('You saves the Post.'));
        return $resultRedirect->setPath('*/*/index');
    }

    public function getButtonData()
    {
        return [
            'label' => __('Save Category'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
