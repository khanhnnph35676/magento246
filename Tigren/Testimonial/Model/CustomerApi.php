<?php
/*
 * @author    Tigren Solutions <info@tigren.com>
 * @copyright Copyright (c) 2024 Tigren Solutions <https://www.tigren.com>. All rights reserved.
 * @license   Open Software License ("OSL") v. 3.0
 *
 */


namespace Tigren\Testimonial\Model;

class CustomerApi implements \Tigren\Testimonial\Api\Data\CustomerApiInterface
{
    protected $_id;
    protected $_title;
    protected $_description;

    public function getId()
    {
        return $this->_id;
    }

    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function setTitle($title)
    {
        $this->_title = $title;
        return $this;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function setDescription($desc)
    {
        $this->_description = $desc;
        return $this;
    }
}
