<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

namespace Tigren\Testimonial\Api;

interface TestApiManagerInterface
{
    /**
     * get test Api data.
     *
     * @param int $entity_id
     *
     * @return \Tigren\Testimonial\Api\Data\TestimonialInterface
     * @api
     *
     */
    public function getApiData($entity_id);

    /**
     * Create new testimonial.
     *
     * @param array $data
     * @return \Tigren\Testimonial\Api\TestApiManagerInterface
     * @api
     */
    public function save(\Tigren\Testimonial\Api\Data\TestimonialInterface $data);
}
