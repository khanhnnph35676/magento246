<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */

namespace Tigren\SimpleBlog\Model;

use Magento\Framework\Model\AbstractModel;

/**
 *  Post class in Model
 */
class Post extends AbstractModel
{
    protected function _construct()
    {
        $this->_init('Tigren\SimpleBlog\Model\ResourceModel\Post');
    }

    public function getPostId()
    {
        return $this->getData('post_id');
    }

    public function setPostId($postId)
    {
        return $this->setData('post_id', $postId);
    }

    // Getter và setter cho trường 'title'
    public function getTitle()
    {
        return $this->getData('title');
    }

    public function setTitle($title)
    {
        return $this->setData('title', $title);
    }

    // Getter và setter cho trường 'post_image'
    public function getPostImage()
    {
        return $this->getData('post_image');
    }

    public function setPostImage($postImage)
    {
        return $this->setData('post_image', $postImage);
    }

    // Getter và setter cho trường 'list_image'
    public function getListImage()
    {
        return $this->getData('list_image');
    }

    public function setListImage($listImage)
    {
        return $this->setData('list_image', $listImage);
    }

    // Getter và setter cho trường 'full_content'
    public function getFullContent()
    {
        return $this->getData('full_content');
    }

    public function setFullContent($fullContent)
    {
        return $this->setData('full_content', $fullContent);
    }

    // Getter và setter cho trường 'short_content'
    public function getShortContent()
    {
        return $this->getData('short_content');
    }

    public function setShortContent($shortContent)
    {
        return $this->setData('short_content', $shortContent);
    }

    // Getter và setter cho trường 'author'
    public function getAuthor()
    {
        return $this->getData('author');
    }

    public function setAuthor($author)
    {
        return $this->setData('author', $author);
    }

    // Getter và setter cho trường 'status'
    public function getStatus()
    {
        return $this->getData('status');
    }

    public function setStatus($status)
    {
        return $this->setData('status', $status);
    }

    // Getter và setter cho trường 'published_at'
    public function getPublishedAt()
    {
        return $this->getData('published_at');
    }

    public function setPublishedAt($publishedAt)
    {
        return $this->setData('published_at', $publishedAt);
    }

    public function getCategoryId()
    {
        return $this->getData('category_id');
    }

    public function setCategoryId($categoryId)
    {
        return $this->setData('category_id', $categoryId);
    }

}
