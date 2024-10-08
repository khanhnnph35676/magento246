<?php
declare(strict_types=1);

namespace Tigren\Testimonial\Api\Data;

interface TestimonialInterface
{
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const MESSAGE = 'message';
    const CUSTOMER_ID = 'customer_id';
    const CREATED_AT = 'created_at';
    const EMAIL = 'email';
    const COMPANY = 'company';
    const RATING = 'rating';
    const PROFILE_IMAGE = 'profile_image';
    const STATUS = 'status';
    /**#@-*/
    /**
     * Get entity_id.
     * @return int|null
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function getEntityId();

    /**
     * Set entity_id.
     * @param int $entity_id
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setEntityId($entity_id);

    /**
     * Get customer_id.
     * @return string|null
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function getCustomerId();

    /**
     * Set customer_id.
     * @param int $customer_id
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setCustomerId($customer_id);

    /**
     * Get name.
     * @return string|null
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function getName();

    /**
     * Set name.
     * @param string $name
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setName($name);

    /**
     * Get Message.
     * @return string|null
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function getMessage();

    /**
     * Set Message.
     * @param string $message
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setMessage($message);

    /**
     * Get Email.
     * @return string|null
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function getEmail();

    /**
     * Set Email.
     * @param string $email
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setEmail($email);

    /**
     * Get company.
     * @return string|null
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function getCompany();

    /**
     * Set company.
     * @param string $company
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setCompany($company);

    /**
     * Get rating.
     * @return string|null
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function getRating();

    /**
     * Set rating.
     * @param string $rating
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setRating($rating);

    /**
     * Get profile_image.
     * @return string|null
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function getProfileImage();

    /**
     * Set profile_image.
     * @param string $profile_image
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setProfileImage($profile_image);

    /**
     * Get status.
     * @return string|null
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function getStatus();

    /**
     * Set status.
     * @param string $status
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setStatus($status);

    /**
     * Get created_at.
     * @return string|null
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function getCreatedAt();

    /**
     * Set created_at.
     * @param string $created_at
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function setCreatedAt($created_at);


}
