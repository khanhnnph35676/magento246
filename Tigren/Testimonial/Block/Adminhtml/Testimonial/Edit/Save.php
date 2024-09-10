<?php
declare(strict_types=1);

namespace Tigren\Testimonial\Block\Adminhtml\Testimonial\Edit;


use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Tigren\Testimonial\Api\Data\TestimonialInterface;
use Tigren\Testimonial\Api\Data\TestimonialInterfaceFactory;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Save CMS block action.
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * @param Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param TestimonialInterfaceFactory $testimonialFactory
     * @param TestimonialRepositoryInterface $testimonialRepository
     */
    public function __construct(
        Context                                         $context,
        private readonly DataPersistorInterface         $dataPersistor,
        private readonly TestimonialInterfaceFactory    $testimonialFactory,
        private readonly TestimonialRepositoryInterface $testimonialRepository
    )
    {
        parent::__construct($context);
    }

    /**
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (isset($data['is_active']) && $data['is_active'] === 'true') {
                $data['is_active'] = TestimonialInterface::STATUS_ENABLED;
            }
            if (empty($data['entity_id'])) {
                $data['entity_id'] = null;
            }

            /** @var \Magento\Cms\Model\Block $model */
            $model = $this->testimonialFactory->create();

            $id = (int)$this->getRequest()->getParam('entity_id');
            if ($id) {
                try {
                    $model = $this->testimonialRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This testimonial no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            try {
                $this->testimonialRepository > save($model);
                $this->messageManager->addSuccessMessage(__('You saved the testimonial.'));
                $this->dataPersistor->clear('testimonial');
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the testimonial.'));
            }

            $this->dataPersistor->set('testimonial', $data);
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
