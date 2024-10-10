<?php
declare(strict_types=1);

namespace Tigren\Testimonial\Api\Data;

interface TestimonialInterface
{
    /**
     * @return int|null
     */
    public function getEntityId();

    /**
     * @param int $entity_id
     * @return TestimonialInterface
     */
    public function setEntityId($entity_id);

    /**
     * @return int|null
     */
    public function getCustomerId();

    /**
     * @param int $customer_id
     * @return TestimonialInterface
     */
    public function setCustomerId($customer_id);

    /**
     * @return string|null
     */
    public function getName();

    /**
     * @param string $name
     * @return TestimonialInterface
     */
    public function setName($name);

    /**
     * @return string|null
     */
    public function getMessage();

    /**
     * @param string $message
     * @return TestimonialInterface
     */
    public function setMessage($message);

    /**
     * @return string|null
     */
    public function getEmail();

    /**
     * @param string $email
     * @return TestimonialInterface
     */
    public function setEmail(string $email);

    /**
     * @return string|null
     */
    public function getCompany();

    /**
     * @param string $company
     * @return TestimonialInterface
     */
    public function setCompany($company);

    /**
     * @return int|null
     */
    public function getRating();

    /**
     * @param int $rating
     * @return TestimonialInterface
     */
    public function setRating($rating);

    /**
     * @return string|null
     */
    public function getProfileImage();

    /**
     * @param string $profile_image
     * @return TestimonialInterface
     */
    public function setProfileImage($profile_image);

    /**
     * @return int|null
     */
    public function getStatus();

    /**
     * @param int $status
     * @return TestimonialInterface
     */
    public function setStatus($status);

    /**
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * @param string $created_at
     * @return TestimonialInterface
     */
    public function setCreatedAt($created_at);
}
