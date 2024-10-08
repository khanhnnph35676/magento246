<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */


namespace Tigren\Testimonial\Api;

interface CustomerManagerInterface
{
    /**
     * get test Api data.
     *
     * @param int $id
     *
     * @return \Tigren\Testimonial\Api\Data\CustomerApiInterface
     * @api
     *
     */
    public function getApiData($id);
}
