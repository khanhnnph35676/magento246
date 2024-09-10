<?php

namespace Tigren\Testimonial\Model;
class Testimonial extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Tigren\Testimonial\Model\ResourceModel\Testimonial');
    }

    public function getName()
    {
        return $this->getData('name');
    }

    // Getter cho 'email'
    public function getEmail()
    {
        return $this->getData('email');
    }

    // Getter cho 'message'
    public function getMessage()
    {
        return $this->getData('message');
    }

    // Getter cho 'created_at'
    public function getRating()
    {
        return $this->getData('rating');
    }

    public function getCopany()
    {
        return $this->getData('company');
    }

    public function getProfileImage()
    {
        return $this->getData('profile_image');
    }

    public function getCreatedAt()
    {
        return $this->getData('created_at');
    }
}
