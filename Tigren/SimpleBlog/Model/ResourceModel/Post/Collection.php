<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

namespace Tigren\SimpleBlog\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Tigren\SimpleBlog\Model\ResourceModel\Post as PostResource;
use Tigren\SimpleBlog\Model\Post as PostModel;

/**
 * Collection Class Post
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'post_id';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            PostModel::class,
            PostResource::class
        );
    }
}
