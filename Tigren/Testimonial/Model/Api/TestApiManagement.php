<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

declare(strict_types=1);


namespace Tigren\Testimonial\Model\Api;

use Psr\Log\LoggerInterface;

class TestApiManagement implements \Tigren\Testimonial\Api\TestApiManagerInterface
{
    protected $_testApiFactory;
    protected $logger;

    public function __construct(
        \Tigren\Testimonial\Model\TestApiFactory $testApiFactory,
        LoggerInterface                          $logger
    )
    {
        $this->_testApiFactory = $testApiFactory;
        $this->logger = $logger;
    }

    /**
     * get test Api data.
     * @param int $entity_id
     *
     * @return \Tigren\Testimonial\Model\TestApi
     * @api
     *
     */
    public function getApiData($entity_id)
    {
        $this->logger->info('Entity ID: ' . $entity_id);
        try {
            $model = $this->_testApiFactory->create();
            $model->setEntityId($entity_id);
            if (!$model->getEntityId()) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('no data found')
                );
            }
            return $model;
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            // Handle exception for localized error
            throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
        } catch (\Exception $e) {
            // Handle generic exception
            throw new \Magento\Framework\Exception\LocalizedException(__('Unable to process the request.'));
        }
    }

    /**
     * Add a new testimonial.
     *
     * @param int|null $customer_id
     * @param string $name
     * @param string $email
     * @param string $message
     * @param string|null $company
     * @param int $rating
     * @param string|null $profile_image
     * @return \Tigren\Testimonial\Api\TestApiManagerInterface
     * @api
     */
    /**
     * Create new testimonial.
     *
     * @param array $data
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     * @api
     */
    public function save(\Tigren\Testimonial\Api\Data\TestimonialInterface $data)
    {
        try {
            if (!$data->getStatus()) {
                $data->setStatus(1);
            }
            $this->_testApiFactory->save();
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->logger->error('Localized exception: ' . $e->getMessage());
            throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
        } catch (\Exception $e) {
            $this->logger->error('Exception while saving testimonial: ' . $e->getMessage());
            throw new \Magento\Framework\Exception\LocalizedException(__('Unable to save testimonial.'));
        }
    }
}
