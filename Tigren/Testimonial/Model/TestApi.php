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
 *
 */
class TestApi implements \Tigren\Testimonial\Api\Data\TestimonialInterface
{
    protected $_entity_id;
    protected $_name;
    protected $_email;
    protected $_message;
    protected $_status;
    protected $_created_at;
    protected $_company;
    protected $_rating;
    protected $_profileImage;
    protected $_customer_id;

    public function getEntityId()
    {
        return $this->_entity_id;
    }

    public function setEntityId($entity_id)
    {
        $this->_entity_id = $entity_id;
        return $this;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setName($name)
    {
        $this->_name = $name;
        return $this;
    }

    public function getMessage()
    {
        return $this->_message;
    }

    public function setMessage($message)
    {
        $this->_message = $message;
        return $this;
    }

    public function getCustomerId()
    {
        return $this->_customer_id;
    }

    public function setCustomerId($customer_id)
    {
        $this->_customer_id = $customer_id;
        return $this;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
        return $this;
    }

    public function getCompany()
    {
        return $this->_company;
    }

    public function setCompany($company)
    {
        $this->_company = $company;
        return $this;
    }

    public function getRating()
    {
        return $this->_rating;
    }

    public function setRating($rating)
    {
        $this->_rating = $rating;
        return $this;
    }

    public function getProfileImage()
    {
        return $this->_profileImage;
    }

    public function setProfileImage($profile_image)
    {
        $this->_profileImage = $profile_image;
        return $this;
    }

    public function getStatus()
    {
        return $this->_status;
    }

    public function setStatus($status)
    {
        $this->_status = $status;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->_created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->_created_at = $created_at;
        return $this;
    }
}
