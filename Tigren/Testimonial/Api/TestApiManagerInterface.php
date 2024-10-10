<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

namespace Tigren\Testimonial\Api;

use Tigren\Testimonial\Api\Data\TestimonialInterface;

/**
 *
 */
interface TestApiManagerInterface
{
    /**
     * @param int $entity_id
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     * @api
     */
    public function getApiData(int $entity_id);

    /**
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     */
    public function save(TestimonialInterface $data): void;

    /**
     * @param int $entity_id
     * @return bool
     */
    public function deleteById(int $entity_id): bool;
}
