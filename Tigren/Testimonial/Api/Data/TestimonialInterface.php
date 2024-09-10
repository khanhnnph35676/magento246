<?php
declare(strict_types=1);

namespace Tigren\Testimonial\Api\Data;

interface TestimonialInterface
{
    public function getEntityId(): int;

    public function setEntityId(int $entityId);

    public function getName(): string;

    public function setName(string $name);

    public function getEmail(): string;

    public function setEmail(string $email);

    public function getMessage(): string;

    public function setMessage(string $message);

    public function getCompany(): ?string;

    public function setCompany(?string $company);

    public function getRating(): int;

    public function setRating(int $rating);

    public function getProfileImage(): ?string;

    public function setProfileImage(?string $profileImage);

    public function getStatus(): int;

    public function setStatus(int $status);

    public function getCreatedAt(): string;

    public function setCreatedAt(string $createdAt);
}
