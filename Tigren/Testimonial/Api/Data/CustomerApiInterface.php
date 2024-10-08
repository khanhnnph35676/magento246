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

    public function getId();

    public function setId($id);

    public function getTitle();

    public function setTitle($title);

    public function getDescription();

    public function setDescription($desc);
}
