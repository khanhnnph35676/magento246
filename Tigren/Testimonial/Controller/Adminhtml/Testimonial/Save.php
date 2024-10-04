<?php

namespace Tigren\Testimonial\Controller\Adminhtml\Testimonial;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Tigren\Testimonial\Model\TestimonialFactory;
use Magento\Backend\App\Action;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Customer\Api\CustomerRepositoryInterface;

/**
 * Class Save
 * @package Tigren\Testimonial\Controller\Adminhtml\Testimonial
 */
class Save extends Action implements ButtonProviderInterface
{
    /**
     * @var TestimonialFactory
     */
    private $testimonialFactory;
    protected $customerSession;
    protected $customerRepository;

    /**
     * Save constructor
     * @param Action\Context $context
     * @param TestimonialFactory $testimonialFactory
     */
    public function __construct(
        Action\Context              $context,
        TestimonialFactory          $testimonialFactory,
        CustomerSession             $customerSession,
        CustomerRepositoryInterface $customerRepository
    )
    {
        parent::__construct($context);
        $this->testimonialFactory = $testimonialFactory;
        $this->customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $selectedCustomers = $this->getRequest()->getParam('selected_customers', []);
        if (!$data) {
            $this->messageManager->addErrorMessage(__('No data found to save.'));
            return $resultRedirect->setPath('*/*/');
        }

//        var_dump($data, $selectedCustomers);
//        dd();
        if (!empty($data['profile_image'][0]['name']) && isset($data['profile_image'][0]['id'])) {
            $data['profile_image'][0] = $data['profile_image'][0]['name'];
        } else {
            unset($data['profile_image']);
        }

        $id = !empty($data['entity_id']) ? $data['entity_id'] : null;
        $image = isset($data['profile_image']) ? $data['profile_image'][0] : null;
        $newData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => $data['status'],
            'message' => $data['message'],
            'rating' => $data['rating'],
            'profile_image' => $image,
//            'customer_id' => $data['data']['customer'],
        ];
//        var_dump($newData);
//        dd();
        $testimonial = $this->testimonialFactory->create();
        if (isset($id)) {
            $testimonial->load($id);
        }
        try {
            $testimonial->addData($newData);
            $testimonial->save();
//            $customerId = $data['data']['customer'];
//            if ($customerId) {
//                $customer = $this->customerRepository->getById($customerId);
//                if (!$customer->getCustomAttribute('is_created_testimonial') ||
//                    !$customer->getCustomAttribute('is_created_testimonial')->getValue()) {
//                    $customer->setCustomAttribute('is_created_testimonial', 1);
//                    $this->customerRepository->save($customer);
//                }
//            }
        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__($exception->getMessage()));
        }
        $this->messageManager->addSuccessMessage(__('You saves the Testimonial.'));
        return $resultRedirect->setPath('*/*/index');
    }

    public function getButtonData()
    {
        return [
            'label' => __('Save Testimonial'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
