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
use Tigren\Testimonial\Api\Data\TestimonialInterface;
use Tigren\Testimonial\Model\TestimonialFactory;
use Tigren\Testimonial\Model\ResourceModel\Testimonial as TestimonialResource;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;

class TestApiManagement implements \Tigren\Testimonial\Api\TestApiManagerInterface
{
    protected $_testApiFactory;
    protected $logger;

    /**
     * @param LoggerInterface $logger
     * @param TestimonialResource $resource
     * @param TestimonialFactory $factory
     */
    public function __construct(
        LoggerInterface                      $logger,
        private readonly TestimonialResource $resource,
        private readonly TestimonialFactory  $factory
    )
    {
        $this->logger = $logger;
    }

    /**
     * get test Api data.
     * @param int $entity_id
     *
     * @return \Tigren\Testimonial\Model\Testimonial
     * @api
     *
     */
    public function getApiData(int $entity_id)
    {
        $this->logger->info('Entity ID: ' . $entity_id);
        $model = $this->factory->create();
        $this->resource->load($model, $entity_id);
        $model->setEntityId($entity_id);
        if (!$model->getEntityId()) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('no data found')
            );
        }
        return $model;
    }

    /**
     * @param \Tigren\Testimonial\Api\Data\TestimonialInterface $data
     * @return void
     */
    public function save(TestimonialInterface $data): void
    {
        $model = $this->factory->create();
        $model->setEntityId($data->getEntityId());
        $model->setCustomerId($data->getCustomerId());
        $model->setName($data->getName());
        $model->setMessage($data->getMessage());
        $model->setEmail($data->getEmail());
        $model->setCompany($data->getCompany());
        $model->setRating($data->getRating());
        $model->setProfileImage($data->getProfileImage());
        $model->setStatus($data->getStatus());
        $model->setCreatedAt($data->getCreatedAt());
        $this->resource->save($model);
    }

    /**
     * @param int $entity_id
     * @return bool
     */
    public function deleteById(int $entity_id): bool
    {
        $data = $this->getApiData($entity_id);
        $this->resource->delete($data);
        return true;
    }
}
