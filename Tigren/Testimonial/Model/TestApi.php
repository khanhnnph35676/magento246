<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

declare(strict_types=1);


namespace Tigren\Testimonial\Model;

/**
 * Marketplace Product Model.
 *
 * @method \Tigren\Testimonial\Model\ResourceModel\Testimonial _getResource()
 * @method \Tigren\Testimonial\Model\ResourceModel\Testimonial getResource()
 */
class TestApi implements \Tigren\Testimonial\Api\Data\TestimonialInterface
{
    /**
     * Get ID.
     *
     * @return int
     */
    public function getEntityId()
    {
        return 3;
    }

    /**
     * Set entity_id.
     *
     * @param int $entity_id
     *
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setEntityId($entity_id)
    {
    }

    /**
     * Get title.
     *
     * @return string|null
     */
    public function getName()
    {
        return 'this is test name';
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setName($name)
    {
    }

    /**
     * Get desc.
     *
     * @return string|null
     */
    public function getMessage()
    {
        return 'this is Message';
    }

    /**
     * Set Desc.
     *
     * @param string $message
     *
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setMessage($message)
    {
    }

    public function getCustomerId()
    {
        return '7';
    }

    /**
     * Set customer_id.
     *
     * @param string $customer_id
     *
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setCustomerId($customer_id)
    {
    }

    public function getEmail()
    {
        return 'khanhnhunguyen@gmail.com';
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setEmail($email)
    {
    }

    public function getCompany()
    {
        return 'nosd';
    }

    /**
     * Set company.
     *
     * @param string $company
     *
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setCompany($company)
    {
    }

    public function getRating()
    {
        return '1';
    }

    /**
     * Set rating.
     *
     * @param string $rating
     *
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setRating($rating)
    {
    }

    public function getProfileImage()
    {
        return '1.jpg';
    }

    /**
     * Set profile_image.
     *
     * @param string $profile_image
     *
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setProfileImage($profile_image)
    {
    }

    public function getStatus()
    {
        return '1';
    }

    /**
     * Set status.
     *
     * @param string $status
     *
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setStatus($status)
    {
    }

    public function getCreatedAt()
    {
        return '2024-10-01 12:34:56';
    }

    /**
     * Set created_at.
     *
     * @param string $created_at
     *
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setCreatedAt($created_at)
    {
    }
}
