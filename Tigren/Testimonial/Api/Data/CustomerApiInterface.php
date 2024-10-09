<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

declare(strict_types=1);

namespace Tigren\Testimonial\Api\Data;

interface CustomerApiInterface
{
    const ENTITY_ID = 'entity_id';
    const TITLE = 'title';
    const DESC = 'description';

    /**
     * Get customer ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * @param $id
     * @return mixed
     */
    public function setId($id);

    /**
     * @return mixed
     */
    public function getTitle();

    /**
     * @param $title
     * @return mixed
     */
    public function setTitle($title);

    /**
     * @return mixed
     */
    public function getDescription();

    /**
     * @param $desc
     * @return mixed
     */
    public function setDescription($desc);
}
