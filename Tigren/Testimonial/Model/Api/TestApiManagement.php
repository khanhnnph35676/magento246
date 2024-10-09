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
            throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Unable to process the request.'));
        }
    }

    /**
     * Create new testimonial.
     *
     * @param \Tigren\Testimonial\Api\Data\TestimonialInterface $data
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     * @api
     */
    public function save(\Tigren\Testimonial\Api\Data\TestimonialInterface $data)
    {
        try {
            // Check and set the status if not already set
            if (!$data->getStatus()) {
                $data->setStatus(1); // Assuming 1 means 'active'
            }

            // Create a new testimonial instance
            $testimonial = $this->_testApiFactory->create(); // Make sure you have the right factory

            // Set the data
            $testimonial->setCustomerId($data->getCustomerId());
            $testimonial->setName($data->getName());
            $testimonial->setEmail($data->getEmail());
            $testimonial->setMessage($data->getMessage());
            $testimonial->setCompany($data->getCompany());
            $testimonial->setRating($data->getRating());
            $testimonial->setProfileImage($data->getProfileImage());
            $testimonial->setStatus($data->getStatus()); // Set status explicitly
            // Save the testimonial
            $testimonial->save(); // Call save on the testimonial instance

            return $testimonial; // Return the saved testimonial object

        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->logger->error('Localized exception: ' . $e->getMessage());
            throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
        } catch (\Exception $e) {
            $this->logger->error('Exception while saving testimonial: ' . $e->getMessage());
            throw new \Magento\Framework\Exception\LocalizedException(__('Unable to save testimonial.'));
        }
    }

    public function update($entity_id, \Tigren\Testimonial\Api\Data\TestimonialInterface $data)
    {
        try {
            $testimonial = $this->_testApiFactory->create()->load($entity_id);
            if (!$testimonial->getId()) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Testimonial with ID "%1" does not exist.', $entity_id)
                );
            }

            // Update fields
            $testimonial->setCustomerId($data->getCustomerId());
            $testimonial->setName($data->getName());
            $testimonial->setEmail($data->getEmail());
            $testimonial->setMessage($data->getMessage());
            $testimonial->setCompany($data->getCompany());
            $testimonial->setRating($data->getRating());
            $testimonial->setProfileImage($data->getProfileImage());
            $testimonial->setStatus($data->getStatus());

            // Save the updated testimonial
            $testimonial->save();

            return $testimonial; // Return the updated testimonial object

        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->logger->error('Localized exception: ' . $e->getMessage());
            throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
        } catch (\Exception $e) {
            $this->logger->error('Exception while updating testimonial: ' . $e->getMessage());
            throw new \Magento\Framework\Exception\LocalizedException(__('Unable to update testimonial.'));
        }
    }

    public function deleteById($entity_id)
    {
        try {
            $testimonial = $this->_testApiFactory->create()->load($entity_id);
            if (!$testimonial->getId()) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('Testimonial with ID "%1" does not exist.', $entity_id)
                );
            }
            // Delete the testimonial
            $testimonial->delete();
            return true; // Return true on successful deletion

        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $this->logger->error('Localized exception: ' . $e->getMessage());
            throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
        } catch (\Exception $e) {
            $this->logger->error('Exception while deleting testimonial: ' . $e->getMessage());
            throw new \Magento\Framework\Exception\LocalizedException(__('Unable to delete testimonial.'));
        }
    }
}
